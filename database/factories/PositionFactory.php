<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Position::class, function (Faker $faker) {
    return [
        'code' => $faker->shuffleString('O10PE2'),
        'name' => $faker->unique()->jobTitle,
        'basic_salary' => $faker->randomFloat(2, 0, 10),
        'user_id' => factory(App\Models\User::class),
    ];
});
