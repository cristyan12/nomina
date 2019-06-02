<?php

use App\User;
use Faker\Generator as Faker;
use Caffeinated\Shinobi\Models\Role;

$factory->define(App\RoleUser::class, function (Faker $faker) {
    return [
        'role_id' => function () {
        	return factory(Role::class)->create()->id;
        },
        'user_id' => function () {
        	return factory(User::class)->create()->id;
        },
    ];
});
