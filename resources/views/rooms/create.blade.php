@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/rooms" method="post">
            @csrf
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="capacity" placeholder="Capacity">
            <input type="submit" value="erstellen">
        </form>
    </div>
@endsection
