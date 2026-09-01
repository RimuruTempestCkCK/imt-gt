<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'locale' => ['required', 'in:id,en'],
        ]);

        $request->session()->put('locale', $validated['locale']);

        $redirectTo = (string) $request->input('redirect_to', '');

        if (! str_starts_with($redirectTo, url('/')) && ! str_starts_with($redirectTo, '/')) {
            $redirectTo = url()->previous() ?: route('home');
        }

        return redirect()->to($redirectTo);
    }
}
