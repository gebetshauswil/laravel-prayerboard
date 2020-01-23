<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\StoreRequest;
use App\Http\Requests\Room\UpdateRequest;
use App\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(StoreRequest $request)
    {
        $attributes = $request->validated();
        Room::create($attributes);

        return redirect(route('rooms.index'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(UpdateRequest $request, Room $room)
    {
        $attributes = $request->validated();
        $room->update($attributes);

        return redirect(route('rooms.show', compact('room')));
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect(route('rooms.index'));
    }
}
