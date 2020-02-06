<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Organisation;
use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'capacity' => $faker->randomDigitNotNull,
        'organisation_id' => factory(Organisation::class)
    ];
});
