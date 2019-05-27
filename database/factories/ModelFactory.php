<?php

use App\User;
use App\Company;
use App\Extras;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Resource;
use App\Reservation;

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

$factory->define(Resource::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(Extras::class, function (Faker $faker) {
    return [];
});

$factory->define(Reservation::class, function (Faker $faker) {
    $date = now()->subDays(rand(-6, 6));
    $date = $date->subHour(rand(1, 23));
    $date = $date->subMinutes(rand(1, 55));
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'resource_id' => factory(Resource::class)->create(),
        'company_id' => factory(Company::class)->create(),
        'user_id' => factory(User::class)->create(),
        'start_time' => $date,
        'end_time' => $date->addHour(rand(1, 5)),
    ];
});
