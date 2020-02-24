<?php

use Faker\Generator as Faker;

$factory->define(App\Concept::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'type' => $faker->randomElement(['asignacion', 'deduccion']),
        'description' => $faker->text,
        'quantity' => $faker->randomFloat(2),
        'calculation_salary' => $faker->word,
        'formula' => $faker->sentence,
        'user_id' => factory('App\User'),
    ];
});
