<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'starting_at' => $faker->dateTime,
        'minutes' => $faker->randomDigit,
        'private' => $faker->boolean,
    ];
});
