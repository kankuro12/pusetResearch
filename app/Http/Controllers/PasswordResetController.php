<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotForm()
    {
        return view('front.auth.forgot-password');
    }

    /**
     * Send OTP for password reset
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! Please try again later or contact site admin.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate OTP
        $otp = Otp::generateOtp($request->email, 'password_reset');

        // Send OTP email
        Mail::to($user->email)->send(new OtpMail($otp, 'password_reset', $user->name));

        return redirect()->route('password.verify.form', ['email' => urlencode($request->email)])
                        ->with('success', 'OTP sent to your email. Please check your inbox.');
    }

    /**
     * Show OTP verification form
     */
    public function showVerifyForm(Request $request)
    {
        $email = urldecode($request->query('email'));
        return view('front.auth.verify-otp', compact('email'));
    }

    /**
     * Verify OTP and show reset password form
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        if (Otp::verifyOtp($request->email, $request->otp, 'password_reset')) {
            // Generate a temporary token for password reset
            $token = bin2hex(random_bytes(32));
            session(['password_reset_token' => $token, 'password_reset_email' => $request->email]);

            return redirect()->route('password.reset.form', ['token' => $token])
                            ->with('success', 'OTP verified! Please enter your new password.');
        }

        return back()->with('error', 'Invalid or expired OTP. Please try again.');
    }

    /**
     * Show reset password form
     */
    public function showResetForm(Request $request, $token)
    {
        if (session('password_reset_token') !== $token) {
            return redirect()->route('password.forgot')->with('error', 'Invalid reset token.');
        }

        $email = session('password_reset_email');
        return view('front.auth.reset-password', compact('token', 'email'));
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (session('password_reset_token') !== $request->token ||
            session('password_reset_email') !== $request->email) {
            return back()->with('error', 'Invalid reset session.');
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Clear session
            session()->forget(['password_reset_token', 'password_reset_email']);

            return redirect()->route('front.login')
                            ->with('success', 'Password reset successfully! You can now login with your new password.');
        }

        return back()->with('error', 'User not found.');
    }
}
