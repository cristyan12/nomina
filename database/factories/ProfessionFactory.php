<?php

use Faker\Generator as Faker;

$factory->define(App\Profession::class, function (Faker $faker) {
    return [
    	'id' => random_int(0, 20),
        'title' => $faker->unique()->jobTitle
    ];
});
