<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {
    return [
        'company_id' => factory('App\Company')->create()->id,
        'bank_id' => factory('App\Bank')->create()->id,
        'number' => $faker->unique()->bankAccountNumber,
        'type' => $faker->randomElement(['Ahorro', 'Corriente']),
        'auth_1' => factory('App\EmployeeProfile')->create()->id,
        'auth_2' => factory('App\EmployeeProfile')->create()->id,
        'user_id' => factory('App\User')->create()->id,
    ];
});
