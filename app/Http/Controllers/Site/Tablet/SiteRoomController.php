<?php

namespace App\Http\Controllers\Site\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;

class SiteRoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();
        return view('site.room.index',compact('rooms'));
    }

    public function create(string $id)
    {
        $room_id = $id;
        return view('site.room.booking', compact('room_id'));
    }

    /**
     * Appropriate Room Booking
     */
    public function room(string $id)
    {

        $room_id = $id;

        $room = Room::select('rooms.id', 'rooms.name', 'rooms.start_date', 'rooms.end_date', 'rooms.created_at', 'rooms.updated_at')
            ->where('id', '=', $room_id)
            ->first();


        $booking = Booking::select('bookings.start_date', 'bookings.end_date')
            ->where('room_id', '=', $room_id)
            ->get();

        return response()->json([
            'room' => $room,
            'booking' => $booking
        ]);

    }



}
