<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $request->user()?->forceFill([
            'last_login_at' => now(),
        ])->save();

        AuditLogger::log('auth.login', 'User berhasil login.');

        if ($request->user()?->hasPermissionTo('dashboard.view')) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('account.company-profile.edit'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        AuditLogger::log('auth.logout', 'User logout dari sistem.');

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
