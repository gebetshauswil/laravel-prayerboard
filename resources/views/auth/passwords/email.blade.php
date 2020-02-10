@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <h1 class="mb-4 text-xl font-bold text-center">{{ __('Reset Password') }}</h1>
        @if (session('status'))
            <div class="text-green-500 text-xs italic mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="mb-6">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email"
                   class="w-full form-input @error('email') mb-3 border-red-500 @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                   placeholder="{{ __('E-Mail Address') }}">
            @error('email')<p class="text-red-500 text-xs italic" role="alert">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
@endsection
