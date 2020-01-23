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
            </div>
        </div>
    </div>
@endsection
