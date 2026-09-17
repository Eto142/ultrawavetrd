<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        try {
            $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt([$loginField => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();

                if (! $request->user()->hasVerifiedEmail()) {
                    return redirect()->route('otp.verify');
                }

                return redirect()->intended(route('user.dashboard'))->with('success', 'Login successful! Welcome back.');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email')->with('error', 'Invalid credentials provided.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong during login. Please try again later.');
        }
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
