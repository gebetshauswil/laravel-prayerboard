@extends('layouts.app')

@section('content')
        <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <h1 class="mb-4 text-xl font-bold text-center">{{ __('Login') }}</h1>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email"
                       class="w-full form-input @error('email') mb-3 border-red-500 @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       placeholder="{{ __('E-Mail Address') }}">
                @error('email')<p class="text-red-500 text-xs italic" role="alert">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
                <input id="password" type="password"
                       class="w-full form-input @error('password') mb-3 border-red-500 @enderror"
                       name="password" required autocomplete="current-password" placeholder="********">
                @error('password')<p class="text-red-500 text-xs italic" role="alert">{{ $message }}</p>@enderror
            </div>
            <div class="flex mb-6">
                <label class="flex items-center" for="remember">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2 cursor-pointer select-none">{{ __('Remember Me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
@endsection
