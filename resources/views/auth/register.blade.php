@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <h1 class="mb-4 text-xl font-bold text-center">{{ __('Register') }}</h1>
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Name') }}</label>
            <input id="name" type="text"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') mb-3 border-red-500 @enderror"
                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                   placeholder="{{ __('Name') }}">
            @error('name')<p class="text-red-500 text-xs italic" role="alert">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') mb-3 border-red-500 @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}">
            @error('email')<p class="text-red-500 text-xs italic" role="alert">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
            <input id="password" type="password"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') mb-3 border-red-500 @enderror"
                   name="password" required autocomplete="new-password" placeholder="********">
            @error('password')<p class="text-red-500 text-xs italic" role="alert">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6">
            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   name="password_confirmation" required autocomplete="new-password" placeholder="********">
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                {{ __('Register') }}
            </button>
        </div>
    </form>
@endsection
