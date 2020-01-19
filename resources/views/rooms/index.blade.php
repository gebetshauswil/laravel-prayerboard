@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Rooms</h1>
                <ul>
                    @forelse($rooms as $room)
                        <li><a href="{{route('rooms.show',compact('room'))}}">{{$room->name}}</a></li>
                    @empty
                        <li>No Rooms yet</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
