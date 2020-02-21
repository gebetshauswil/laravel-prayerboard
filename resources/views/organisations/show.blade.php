@extends('layouts.dashboard')

@section('content')
    <a href="{{route('organisations.index')}}" class="inline-block mb-6">&larr; back to list</a>
    <h1 class="text-4xl mb-6">{{$organisation->name}}</h1>
@endsection
