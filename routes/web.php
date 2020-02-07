<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$domain = parse_url(config('app.url'))['host'];

Route::domain('{organisation}.' . $domain)->group(function () {
    Route::get('/', function (\App\Organisation $organisation) {
        dd($organisation);

    });
});

Route::domain($domain)->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get(null, 'DashboardController@index')->name('dashboard');
        Route::resource('organisations', 'OrganisationController');
        Route::resource('rooms', 'RoomController');
        Route::resource('bookings', 'BookingController');
    });
});
