<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\OtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'in:Female,Male,Others'],
            'country' => ['required', 'string', 'max:255'],
            'currency_code' => ['required', 'string', 'size:3'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha' => ['required', 'numeric', 'same:captcha_confirmation'],
            'account' => ['nullable', 'array'],
            'account.*' => ['string'],
        ]);

        try {
            $code = (string) random_int(100000, 999999);

            $referrerCode = $request->input('ref') ?: session('ref_code');
            $referrer = $referrerCode ? User::where('referral_code', $referrerCode)->first() : null;

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'country' => $request->country,
                'currency_code' => $request->currency_code,
                'account_types' => $request->account ?? [],
                'password' => Hash::make($request->password),
                'referred_by' => $referrer?->id,
            ]);

            session()->forget('ref_code');

            $user->forceFill([
                'otp_code' => $code,
                'otp_expires_at' => now()->addMinutes(10),
            ])->save();

            Auth::login($user);

            $user->notify(new OtpNotification($code));

            return redirect()->route('otp.verify')->with('success', 'Registration successful! Please verify your email to continue.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong during registration. Please try again later.');
        }
    }
}
