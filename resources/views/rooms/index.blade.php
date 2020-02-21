@extends('layouts.dashboard')

@section('content')
    <h1 class="text-4xl mb-6">Rooms</h1>

    <ul>
        @forelse($rooms as $room)
            <li><a href="{{route('rooms.show',compact('room'))}}">{{$room->name}}</a></li>
        @empty
            <li>No Rooms yet</li>
        @endforelse
    </ul>
    <a href="{{route('rooms.create')}}">Room erstellen</a>
@endsection
