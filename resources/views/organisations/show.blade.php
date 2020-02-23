@extends('layouts.dashboard')

@section('content')
    <a href="{{route('organisations.index')}}" class="inline-block mb-6">&larr; back to list</a>
    <h1 class="text-4xl mb-6">{{$organisation->name}}</h1>
    <table class="mb-12">
        <tr>
            <th class="pr-3">Name</th>
            <td>{{$organisation->name}}</td>
        </tr>
        <tr>
            <th class="pr-3">Slug</th>
            <td>{{$organisation->slug}}</td>
        </tr>
    </table>
    <a href="{{route('organisations.edit',compact('organisation'))}}"
       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit
        organisation</a>
@endsection
