<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Room;

// TODO MR: look at this https://blog.pusher.com/build-rest-api-laravel-api-resources/
// TODO MR: handle errors and send them back correctly
class RoomController extends Controller
{
    public function index()
    {
        return RoomResource::collection(Room::all());
    }

    public function show(Room $room)
    {
        return new RoomResource($room);
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'capacity' => 'required|numeric',
        ]);

        $room = Room::create($attributes);

        return new RoomResource($room);
    }

    public function update(Room $room)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'capacity' => 'required|numeric',
        ]);

        $room->update($attributes);

        return new RoomResource($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(null, 204);
    }
}
