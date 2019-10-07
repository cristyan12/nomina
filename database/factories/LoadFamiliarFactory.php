<?php

use Faker\Generator as Faker;

$factory->define(App\LoadFamiliar::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User'),
        'employee_id' => factory('App\Employee'),
        'name' => $faker->name,
        'relationship' => $faker->randomElement([
            'Hijo', 'Hija', 'Pareja', 'Madre', 'Padre'
        ]),
        'document' => $faker->randomNumber,
        'sex' => $faker->randomElement(['M', 'F']),
        'born_at' => $faker->date,
        'instruction' => $faker->randomElement([
            'Estudiante', 'Bachiller', 'TSU', 'Licenciado o Ingeniero'
        ]),
        'reference' => $faker->sentence,
    ];
});
