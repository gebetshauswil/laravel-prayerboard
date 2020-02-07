<?php
use App\Organisation;
use App\Room;

Route::domain('{organisation}.' . $domain)->group(function () {
    Route::get('/', function (Organisation $organisation) {
        dd($organisation->name);

    });
    Route::get('/rooms', function (Organisation $organisation) {
        dd($organisation->name, $organisation->rooms);
    });
    Route::get('/rooms/{room}', function (Organisation $organisation, Room $room) {
        dd($organisation->name, $room->name);
    });
});
