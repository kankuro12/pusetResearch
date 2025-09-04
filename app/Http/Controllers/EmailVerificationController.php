<?php

namespace App\Http\Controllers;

use App\Models\EmailVerification;
use App\Models\User;
use App\Mail\EmailVerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    /**
     * Verify email with token
     */
    public function verify(Request $request, $email, $token)
    {
        $email = urldecode($email);

        // Verify the token
        if (EmailVerification::verifyToken($email, $token)) {
            // Find the user and mark email as verified
            $user = User::where('email', $email)->first();

            if ($user) {
                $user->markEmailAsVerified();

                return redirect()->route('front.login')->with('success', 'Email verified successfully! You can now login to your account.');
            }
        }

        return redirect()->route('front.login')->with('error', 'Invalid or expired verification link. Please register again.');
    }

    /**
     * Resend verification email
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! Please try again later or contact site admin.',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->hasVerifiedEmail()) {
            return back()->with('error', 'Email is already verified.');
        }

        // Generate new verification token
        $token = EmailVerification::generateToken($user->email);
        $verificationUrl = route('email.verify', [
            'email' => urlencode($user->email),
            'token' => $token
        ]);

        // Send verification email
        Mail::to($user->email)->send(new EmailVerificationMail($verificationUrl, $user->name));

        return back()->with('success', 'Verification email sent successfully! Please check your inbox.');
    }

    /**
     * Show resend verification form
     */
    public function showResendForm()
    {
        return view('front.auth.resend-verification');
    }
}
