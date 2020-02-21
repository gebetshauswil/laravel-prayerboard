@extends('layouts.dashboard')

@section('content')
    <h1 class="text-4xl mb-6">Organisations</h1>

    <ul class="list-disc list-inside mb-12">
        @forelse($organisations as $organisation)
            <li><a href="{{route('organisations.show',compact('organisation'))}}">{{$organisation->name}}</a></li>
        @empty
            <li>No Organisations yet</li>
        @endforelse
    </ul>
    <a href="{{route('organisations.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create organisation</a>
@endsection
