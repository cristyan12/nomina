<?php

use Faker\Generator as Faker;

$factory->define(App\BankOfPay::class, function (Faker $faker) {
    return [
        'code' => $faker->shuffleString('O102'),
        'name' => $faker->name,
    ];
});
