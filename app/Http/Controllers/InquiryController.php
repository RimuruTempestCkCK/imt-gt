<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // If user is a supplier, they see received inquiries.
        // If user is a buyer, they see sent inquiries.
        // We'll just show both or separate them.
        
        $receivedInquiries = Inquiry::where('recipient_id', $user->id)->latest()->get();
        $sentInquiries = Inquiry::where('sender_id', $user->id)->latest()->get();
        
        return view('account.inquiries.index', compact('receivedInquiries', 'sentInquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        // Check authorization
        if (auth()->id() !== $inquiry->sender_id && auth()->id() !== $inquiry->recipient_id) {
            abort(403);
        }

        // Mark as read if recipient opens it
        if (auth()->id() === $inquiry->recipient_id && $inquiry->status === 'unread') {
            $inquiry->update(['status' => 'read']);
        }

        return view('account.inquiries.show', compact('inquiry'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'product_id' => 'nullable|exists:products,id',
            'company_profile_id' => 'nullable|exists:company_profiles,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Inquiry::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $request->recipient_id,
            'product_id' => $request->product_id,
            'company_profile_id' => $request->company_profile_id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'unread',
        ]);

        return back()->with('success', 'Inquiry / Pesan berhasil dikirim ke supplier!');
    }
}
