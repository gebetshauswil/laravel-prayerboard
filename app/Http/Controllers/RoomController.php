<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

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

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'capacity' => ['required', 'numeric'],
        ]);

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

    public function update(Room $room)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'capacity' => ['required', 'numeric'],
        ]);
        $room->update($attributes);
        return redirect(route('rooms.show', compact('room')));
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect(route('rooms.index'));
    }
}
