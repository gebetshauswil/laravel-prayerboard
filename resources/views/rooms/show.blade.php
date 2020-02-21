@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{$room->name}}</h1>
                <p>Capacity: {{$room->capacity}}</p>
                <ul>
                    @forelse($room->bookings as $booking)
                        <li>
                            Start: {{Carbon\Carbon::parse($booking->starting_at)->toFormattedDateString()}}<br>
                            Dauer: {{$booking->minutes}}<br>
                            Privat: {{$booking->private}}
                        </li>
                    @empty
                        <li>No Bookings yet.</li>
                    @endforelse
                </ul>
                <a href="{{route('rooms.edit',compact('room'))}}">Raum bearbeiten</a><br><br>
                <form action="{{route('rooms.destroy',compact('room'))}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Raum löschen</button>
                </form>
            </div>
        </div>
    </div>

    <a href="{{route('rooms.index')}}" class="display-block mb-2">zur Raumliste</a>
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
