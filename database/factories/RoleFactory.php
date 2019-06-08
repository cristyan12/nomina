<?php

use Faker\Generator as Faker;
use Caffeinated\Shinobi\Models\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->unique()->slug,
        'description' => $faker->sentence,
    ];
});

// $factory->define(Role::class, function (Faker $faker) {
//     return [
//         'name' => 'admin',
//         'slug' => 'all-access',
//         'description' => $faker->sentence,
//     ];
// });
