<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class UserDashboardController extends Controller
{

    public function index()
    {
        $user = auth()->guard('user')->user();

        $user_booking = Booking::where('user_id', $user->id)->count();

        return view('site.user.dashboard', compact('user', 'user_booking'));
    }

}
