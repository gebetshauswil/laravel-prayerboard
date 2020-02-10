@extends('layouts.dashboard')

@section('content')
    <h1 class="text-4xl mb-6">Organisations</h1>

    <ul>
        @forelse($organisations as $organisation)
            <li><a href="{{route('organisations.show',compact('organisation'))}}">{{$organisation->name}}</a></li>
        @empty
            <li>No Organisations yet</li>
        @endforelse
    </ul>
    <a href="{{route('organisations.create')}}">Organisation erstellen</a>
@endsection
