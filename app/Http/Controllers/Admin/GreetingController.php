<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGreetingRequest;
use App\Models\Greeting;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GreetingController extends Controller
{
    public function index(): View
    {
        return view('admin.cms.greetings.index', [
            'greetings' => Greeting::query()->orderBy('sort_order')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.cms.greetings.create');
    }

    public function store(StoreGreetingRequest $request): RedirectResponse
    {
        $greeting = Greeting::query()->create([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.greeting.created', 'Sambutan dibuat.', $greeting);

        return redirect()->route('admin.greetings.index')->with('status', 'Sambutan berhasil dibuat.');
    }

    public function edit(Greeting $greeting): View
    {
        return view('admin.cms.greetings.edit', compact('greeting'));
    }

    public function update(StoreGreetingRequest $request, Greeting $greeting): RedirectResponse
    {
        $greeting->update([
            ...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        AuditLogger::log('cms.greeting.updated', 'Sambutan diperbarui.', $greeting);

        return redirect()->route('admin.greetings.index')->with('status', 'Sambutan berhasil diperbarui.');
    }

    public function destroy(Greeting $greeting): RedirectResponse
    {
        $greeting->delete();

        AuditLogger::log('cms.greeting.deleted', 'Sambutan dihapus.');

        return back()->with('status', 'Sambutan berhasil dihapus.');
    }
}
