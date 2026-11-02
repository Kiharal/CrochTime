<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredCustomerController extends Controller
{
    public function create(): View
    {
        $customer = new Customer();
        return view('customer.auth.register', compact('customer'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Customer::class],
            'instagram' => 'nullable|string|max:30',
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'instagram' => $request->instagram,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Fires the listener that sends the verification email (Customer::sendEmailVerificationNotification).
        event(new Registered($customer));

        Auth::guard('customer')->login($customer);

        return redirect()->route('customer.verification.notice');
    }
}
