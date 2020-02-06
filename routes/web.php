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


Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'dashboard'], function () {
    Auth::routes(['prefix' => 'admin']);
    Route::get(null, 'DashboardController@index')->name('dashboard');
    Route::resource('organisations', 'OrganisationController');
    Route::resource('rooms', 'RoomController');
    Route::resource('bookings', 'BookingController');
});


