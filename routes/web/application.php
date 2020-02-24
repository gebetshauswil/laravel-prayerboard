<?php

Route::domain($domain)->group(function () {
    Route::get('/', function () {
        return view('index');
    });

    Auth::routes(['verify' => true]);

    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'dashboard'], function () {
        Route::get(null, 'DashboardController@index')->name('dashboard');
        Route::resource('organisations', 'OrganisationController');
        Route::resource('rooms', 'RoomController');
        Route::resource('bookings', 'BookingController');
        Route::resource('users', 'UserController');
    });
});
