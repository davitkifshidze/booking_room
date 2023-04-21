<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestBooking;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    /**
     * Display a Booking
     */
    public function index(Request $request)
    {

        $room_id = $request->input('room__filter');
        $date = $request->input('date__filter');

        $query = Booking::select('bookings.id', 'rooms.name as room_name', 'users.name as user_name', 'users.surname as user_surname', 'bookings.start_date', 'bookings.end_date', 'bookings.created_at', 'bookings.updated_at')
            ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->orderBy('bookings.id', 'DESC');

        if ($date):
            $query->whereDate('bookings.start_date', '=', $date);
        else:
            $query->whereDate('bookings.start_date', '=', Carbon::today());
        endif;


        if ($room_id):
            $query->where('bookings.room_id', '=', $room_id);
        endif;

        $bookings = $query->get();

        $rooms = Room::all();
        $users = User::all();

        return view('admin.booking.index', compact('bookings','rooms', 'users', 'room_id', 'date'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        $users = User::all();

        return response()->json([
            'rooms' => $rooms,
            'users' => $users,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestBooking $request)
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
     * Appropriate Room
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json(['success' => true]);
    }

}
