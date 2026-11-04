<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;


class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('customer.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => ['required', Rules\Password::default()]
        ]);

        if(Auth::guard('cutomer')->attempt($validated)){
            $request->session()->regenerate();
            return redirect()->intended(route('launch'));
        }
        throw ValidationException::withMessages(['email' => __('auth_failed')]);
        


    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();

        // Deliberately not session()->invalidate(): that flushes the whole session and
        // would also log this browser out of the manufacturer guard.
        $request->session()->regenerateToken();

        return redirect()->route('customer.login');
    }
}
