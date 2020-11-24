<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Bank::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(4),
        'name' => $faker->company,
    ];
});
