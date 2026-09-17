<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class WalletController extends Controller
{
    /**
     * Display the connect wallet page.
     */
    public function connect()
    {
        return view('user.connect-wallet');
    }

}
