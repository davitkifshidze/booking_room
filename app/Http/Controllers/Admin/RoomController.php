<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestRoom;
use App\Models\Room;

class RoomController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rooms = Room::select('rooms.id' , 'rooms.name', 'rooms.start_date', 'rooms.end_date', 'rooms.created_at', 'rooms.updated_at')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.room.index', compact('rooms'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestRoom $request)
    {

        $room = Room::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json(['success' => 'create_success']);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $room_id = $id;

        $room = Room::select('rooms.id' , 'rooms.name', 'rooms.start_date', 'rooms.end_date', 'rooms.created_at', 'rooms.updated_at')
            ->where('id', '=', $room_id)
            ->first();

        return response()->json($room);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestRoom $request, string $id)
    {

        $room = Room::find($id);

        $room->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json(['success' => 'true']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $room = Room::findOrFail($id);
        $room->delete();

        return response()->json(['success' => true]);
    }

}
