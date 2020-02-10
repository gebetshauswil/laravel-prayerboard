@extends('layouts.dashboard')

@section('content')
    <h1 class="text-4xl mb-6">Dashboard</h1>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    You are logged in!
@endsection
