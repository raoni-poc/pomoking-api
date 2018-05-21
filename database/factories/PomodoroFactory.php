<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\ActiveRecord\Pomodoro::class, function (Faker $faker) {
    $canceledAt = mt_rand(0,100);

    return [
        'start' => $faker->dateTime,
        'duration_in_minutes' => mt_rand(20, 30),
        'canceled_at' => ($canceledAt < 75) ? $faker->dateTime : null,
        'deleted_at' => null,
    ];
});
