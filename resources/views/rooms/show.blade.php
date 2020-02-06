@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('rooms.index')}}">zur Raumliste</a><br><br>
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
@endsection
