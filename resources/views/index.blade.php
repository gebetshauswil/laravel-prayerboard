@extends('layouts.app')

@section('content')
    <div class="text-center">
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
    </div>
@endsection
