<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $referrals = $user->referrals()->latest()->get();

        return view('user.referrals', compact('user', 'referrals'));
    }

    public function redirect(string $code)
    {
        if (User::where('referral_code', $code)->exists()) {
            session(['ref_code' => $code]);
        }

        return redirect()->route('register');
    }
}
