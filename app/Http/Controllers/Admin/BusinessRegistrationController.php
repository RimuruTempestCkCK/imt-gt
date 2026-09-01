<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessRegistration;
use App\Models\User;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BusinessRegistrationController extends Controller
{
    public function index()
    {
        $registrations = BusinessRegistration::latest()->paginate(20);
        return view('admin.business-registrations.index', compact('registrations'));
    }

    public function show(BusinessRegistration $businessRegistration)
    {
        return view('admin.business-registrations.show', compact('businessRegistration'));
    }

    public function approve(BusinessRegistration $businessRegistration)
    {
        if ($businessRegistration->status !== 'pending') {
            return back()->with('error', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        // Create User
        $user = User::firstOrCreate(
            ['email' => $businessRegistration->email],
            [
                'name' => $businessRegistration->pic_name,
                'password' => $businessRegistration->password, // Already hashed during registration
                'account_type' => $businessRegistration->account_type,
                'province' => $businessRegistration->province,
            ]
        );

        // Assign Role
        if (!$user->hasRole('supplier')) {
            $user->assignRole('supplier');
        }

        // Create Company Profile
        CompanyProfile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'company_name' => $businessRegistration->company_name,
                'business_email' => $businessRegistration->email,
                'business_phone' => $businessRegistration->phone,
                'province' => $businessRegistration->province,
            ]
        );

        $businessRegistration->update(['status' => 'approved']);

        return redirect()->route('admin.business-registrations.index')->with('success', 'Perusahaan disetujui dan akun berhasil dibuat.');
    }

    public function reject(BusinessRegistration $businessRegistration)
    {
        if ($businessRegistration->status !== 'pending') {
            return back()->with('error', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        $businessRegistration->update(['status' => 'rejected']);

        return redirect()->route('admin.business-registrations.index')->with('success', 'Pendaftaran perusahaan ditolak.');
    }
}
