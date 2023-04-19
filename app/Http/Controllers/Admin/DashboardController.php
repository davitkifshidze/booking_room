<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $users = User::count();
        $rooms = Room::count();
        $bookings = Booking::count();

        return view('admin.dashboard',compact('users', 'rooms', 'bookings'));
    }
}
