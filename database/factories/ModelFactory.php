<?php

use App\User;
use App\Company;
use App\Room;
use App\Extras;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Booking;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Room::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
    ];
});

$factory->define(Extras::class, function (Faker $faker) {
    return [
    ];
});

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'title' => 'TestEvent',
        'description' => 'Here we be testing',
        'resource_id' => factory(Room::class)->create(),
        'company_id' => factory(Company::class)->create(),
        'user_id' => factory(User::class)->create(),
        'start_time' => now(),
        'end_time' => now()->addHour(1),
    ];
});
