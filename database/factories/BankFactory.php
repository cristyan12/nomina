<?php

use Faker\Generator as Faker;

$factory->define(App\Bank::class, function (Faker $faker) {
    return [
        'code' => $faker->randomElement([
            '0102', '0105', '0108', '0114', '0138', '0175', 
        ]),
        'name' => $faker->company,
    ];
});
