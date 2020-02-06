@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Organisations</h1>
                <ul>
                    @forelse($organisations as $organisation)
                        <li><a href="{{route('organisations.show',compact('organisation'))}}">{{$organisation->name}}</a></li>
                    @empty
                        <li>No Organisations yet</li>
                    @endforelse
                </ul>
                <a href="{{route('organisations.create')}}">Organisation erstellen</a>
            </div>
        </div>
    </div>
@endsection
