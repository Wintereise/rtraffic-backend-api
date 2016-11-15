<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Location::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(3),
        'from_long' => $faker->randomFloat(2, 0, 180),
        'from_lat' => $faker->randomFloat(2, 0, 180),
        'to_long' => $faker->randomFloat(2, 0, 180),
        'to_lat' => $faker->randomFloat(2, 0, 180),
        'center_long' => $faker->randomFloat(2, 0, 180),
        'center_lat' => $faker->randomFloat(2, 0, 180),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});