<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Handle the signed link from the verification email.
     * EmailVerificationRequest checks the id/hash against the logged-in customer.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Marks the email as verified and fires the Verified event (no-op if already verified).
        $request->fulfill();

        return redirect()->intended(route('launch'))
            ->with('status', 'Your email address is verified.');
    }
}
