<?php

use Faker\Generator as Faker;

$factory->define(App\Tabulator::class, function (Faker $faker) {
    return [
        'code' => $faker->shuffleString('O10PE2'),
        'name' => strtoupper($faker->unique()->jobTitle),
        'basic_salary' => $faker->randomFloat(2, 0, 10),
    ];
});
