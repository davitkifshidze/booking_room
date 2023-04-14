<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Room;
use App\Models\Admin\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $user = User::count();
        $room = Room::count();

        return view('admin.dashboard',compact('user', 'room'));
    }
}
