<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(Request $request)
    {
        $balance = Balance::for($request->user());

        return view('user.home', compact('balance'));
    }

    public function profile()
    {
        return view('user.profile');
    }

}
