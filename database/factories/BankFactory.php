<?php

use Faker\Generator as Faker;

$factory->define(App\Bank::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(4),
        'name' => $faker->company,
    ];
});
