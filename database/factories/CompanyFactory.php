<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'rif' => $faker->unique()->randomNumber,
        'address' => $faker->address,
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->email,
        'city' => $faker->city,
        'user_id' => factory('App\User'),
    ];
});
