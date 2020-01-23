<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Room\StoreRequest;
use App\Http\Requests\Api\Room\UpdateRequest;
use App\Http\Resources\RoomResource;
use App\Room;

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

    public function store(StoreRequest $request)
    {
        $attributes = $request->validated();
        $room = Room::create($attributes);

        return new RoomResource($room);
    }

    public function update(UpdateRequest $request, Room $room)
    {
        $attributes = $request->validated();
        $room->update($attributes);

        return new RoomResource($room);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(null, 204);
    }
}
