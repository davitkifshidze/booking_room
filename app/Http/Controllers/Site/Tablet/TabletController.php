<?php

namespace App\Http\Controllers\Site\Tablet;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTabletBooking;
use App\Http\Requests\RequestUserCheck;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TabletController extends Controller
{

    public function index()
    {
        $rooms = Room::all();
        return view('site.tablet.index',compact('rooms'));
    }

    public function create(string $id)
    {
        $room_id = $id;
        return view('site.tablet.booking', compact('room_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestTabletBooking $request)
    {

        $booking_start_date = $request->input('start_date');
        $currentDateTime = Carbon::now('Asia/Tbilisi')->format('Y-m-d H:i:s');

        if ($currentDateTime > $booking_start_date ) {
            return response()->json(['message' => 'დღევანდელი ჯავშნის დრო გასულია'], 400);
        }


        $room_id = $request->room_id;

        $room = Room::select('rooms.id', 'rooms.start_date', 'rooms.end_date')
            ->where('id', '=', $room_id)
            ->first();

        $room_end_date = $room->end_date;
        $room_end_date_subtract_hour = Carbon::createFromFormat('H:i', $room_end_date)
            ->subHour()
            ->setDate(Carbon::now()->year, Carbon::now()->month, Carbon::now()->day)
            ->toDateTimeString();

        $booking_date = Carbon::parse($booking_start_date)->format('Y-m-d');
        $current_date = Carbon::now()->format('Y-m-d');

        if (($booking_date == $current_date) && ($booking_start_date > $room_end_date_subtract_hour) ) {
            return response()->json(['message' => 'ჯავშანი შეუძლებელია აირჩიეთ ვალიდური დრო'], 400);
        }

        $booking = Booking::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json(['success' => 'create_success']);

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

    /**
     * Check User
     */
    public function user(RequestUserCheck $request)
    {

        $personal_number = $request->input('personal_number');
        $password = $request->input('password');

        $user = User::where('personal_number', $personal_number)->first();

        if ($user && password_verify($password, $user->password)) {
            return response()->json([
                'success' => true,
                'message' => 'მომხმარებელი ვალიდურია',
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'მსგავსი მომხმარებელი არარსებობს',
            ]);
        }

    }

}
