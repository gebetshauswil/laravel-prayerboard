@extends('layouts.dashboard')

@section('content')
        <a href="{{route('organisations.index')}}" class="inline-block mb-6">&larr; back to list</a>
        <form method="POST" action="{{ route('organisations.store') }}">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input id="name" type="text"
                       class="w-full form-input @error('name') mb-3 border-red-500 @enderror"
                       name="name" value="{{ old('name') }}" required autofocus
                       placeholder="Name">
                @error('name')<p class="text-red-500 text-xs italic" role="alert">{{ $message }}</p>@enderror
            </div>
            <div class="flex">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">Create</button>
            </div>
        </form>
@endsection
