<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Booking;
use App\Models\Admin\Room;
use App\Models\Admin\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $users = User::count();
        $rooms = Room::count();
        $bookings = Booking::count();

        return view('admin.dashboard',compact('users', 'rooms', 'bookings'));
    }
}
