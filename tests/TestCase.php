<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function admin()
    {
		$user = factory(\App\User::class)->make();
		$role = factory(\Caffeinated\Shinobi\Models\Role::class)->make([
			'name' => 'admin',
			'special' => 'all-access',
		]);

		return factory(\App\RoleUser::class)->create([
			'role_id' => $role->id,
			'user_id' => $user->id,
		]);
    }

    public function create($class, $attributes = [])
    {
        return factory($class)->create($attributes);
    }

    public function someUser(array $attributes = [])
    {
        return factory(\App\User::class)->create($attributes);
    }
}
