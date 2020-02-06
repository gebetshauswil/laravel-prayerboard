@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('rooms.show',compact('room'))}}">zurück zum Raum</a><br><br>
        <form action="{{route('rooms.update', compact('room'))}}" method="post">
            @csrf
            @method('patch')
            <input type="text" name="name" placeholder="Name" value="{{$room->name}}">
            <input type="text" name="capacity" placeholder="Capacity" value="{{$room->capacity}}">
            <input type="submit" value="updaten">
        </form>
    </div>
@endsection
