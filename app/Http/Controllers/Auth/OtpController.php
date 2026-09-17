<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\OtpNotification;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    /**
     * Show the OTP verification screen.
     */
    public function show(Request $request)
    {
        $user = $request->user();

        if ($user && $user->hasVerifiedEmail()) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.verify-otp', ['email' => $user?->email]);
    }

    /**
     * Verify the submitted OTP code.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'digits:6'],
        ]);

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('user.dashboard');
        }

        if (! $user->otp_code || ! $user->otp_expires_at || $user->otp_expires_at->isPast()) {
            return back()->with('error', 'Your code has expired. Please request a new one.');
        }

        if ($request->otp !== $user->otp_code) {
            return back()->with('error', 'The code you entered is incorrect.');
        }

        $user->forceFill([
            'email_verified_at' => now(),
            'otp_code' => null,
            'otp_expires_at' => null,
        ])->save();

        return redirect()->route('user.dashboard')->with('success', 'Email verified! Welcome to your dashboard.');
    }

    /**
     * Resend a fresh OTP code to the user.
     */
    public function resend(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('user.dashboard');
        }

        if ($user->otp_expires_at && $user->otp_expires_at->subMinutes(9)->isFuture()) {
            return back()->with('error', 'Please wait a moment before requesting another code.');
        }

        $code = (string) random_int(100000, 999999);

        $user->forceFill([
            'otp_code' => $code,
            'otp_expires_at' => now()->addMinutes(10),
        ])->save();

        $user->notify(new OtpNotification($code));

        return back()->with('success', 'A new verification code has been sent to your email.');
    }
}
