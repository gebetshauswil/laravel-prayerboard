<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
</head>
<body class="bg-white leading-normal tracking-normal text-gray-900 font-thin font-nunito">
<div class="h-screen relative flex flex-col justify-between items-center">
    <header class="px-6 py-5 w-full flex justify-between flex-row">
        <div>
            <a href="/"
               class="text-sm lg:text-base tracking-wide uppercase font-semibold px-4 text-gray-600 hover:text-gray-900">Home</a>
        </div>
        <div>
            @if (Route::has('login'))
                @auth
                    <a class="text-sm lg:text-base tracking-wide uppercase font-semibold px-4 text-gray-600 hover:text-gray-900"
                       href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="text-sm lg:text-base tracking-wide uppercase font-semibold px-4 text-gray-600 hover:text-gray-900"
                       href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a class="text-sm lg:text-base tracking-wide uppercase font-semibold px-4 text-gray-600 hover:text-gray-900"
                           href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>
    <main class="text-center">
        <h1 class="text-5xl lg:text-7xl text-gray-700 mb-4 lg:mb-8">{{ config('app.name', 'Laravel') }}</h1>
        <ul class="flex flex-col lg:flex-row justify-center">
            <li>
                <a class="text-sm lg:text-base tracking-wide uppercase font-semibold px-4 text-gray-600 hover:text-gray-900"
                   href="https://github.com/gebetshauswil/prayerboard">github</a></li>
            <li>
                <a class="text-sm lg:text-base tracking-wide uppercase font-semibold px-4 text-gray-600 hover:text-gray-900"
                   href="https://github.com/gebetshauswil/prayerboard/issues">issues</a></li>
            <li>
                <a class="text-sm lg:text-base tracking-wide uppercase font-semibold px-4 text-gray-600 hover:text-gray-900"
                   href="https://github.com/gebetshauswil/prayerboard/wiki">docs</a></li>
        </ul>
    </main>
    <footer class="px-6 py-5 flex">
        <a class="text-sm lg:text-base tracking-wide uppercase font-semibold px-4 text-gray-600 hover:text-gray-900"
           href="https://gebetshauswil.ch">&copy; {{date('Y')}} by gebetshaus wil</a>
    </footer>
</div>
</body>
</html>
