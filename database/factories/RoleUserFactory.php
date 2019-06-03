<?php

use App\User;
use Faker\Generator as Faker;
use Caffeinated\Shinobi\Models\Role;

$factory->define(App\RoleUser::class, function (Faker $faker) {
    return [
        'role_id' => factory(Role::class)->create()->id,
        'user_id' => factory(User::class)->create()->id,
    ];
});
