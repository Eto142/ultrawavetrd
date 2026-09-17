<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('user.notifications');
    }

    public function unread()
    {
        return response()->json(['notifications' => [], 'count' => 0]);
    }

    public function readAll()
    {
        return response()->json(['success' => true]);
    }
}
