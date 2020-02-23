@extends('layouts.dashboard')

@section('content')
    <a href="{{route('organisations.show',compact('organisation'))}}" class="inline-block mb-6">&larr; back to organisation</a>
    <h1 class="text-4xl mb-6">Edit Organisation</h1>

        <form method="POST" action="{{ route('organisations.update', compact('organisation')) }}">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input id="name" type="text"
                       class="w-full form-input @error('name') mb-3 border-red-500 @enderror"
                       name="name" value="{{ $organisation->name }}" required
                       placeholder="Name">
                @error('name')<p class="text-red-500 text-xs italic" role="alert">{{ $message }}</p>@enderror
            </div>
            <div class="flex">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">Save</button>
            </div>
        </form>
@endsection
