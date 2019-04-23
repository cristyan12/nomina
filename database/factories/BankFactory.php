<?php

use Faker\Generator as Faker;

$factory->define(App\Bank::class, function (Faker $faker) {
	$firstEmployee = factory(App\Employee::class)->create();

	$secondEmployee = factory(App\Employee::class)->create();

    return [
        'code' => $faker->numberBetween(1, 1000),
        'name' => $faker->company,
        'account' => $faker->bankAccountNumber,
        'account_type' => $faker->randomElement(['Corriente', 'Ahorro']),
        'first_sign_auth' => $firstEmployee->id,
        'first_sign_position' => $firstEmployee->position,
        'second_sign_auth' => $secondEmployee->id,
        'second_sign_position' => $secondEmployee->position
    ];
});
