<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function create($class, $times = null, $attributes = [])
    {
        return factory($class, $times)->create($attributes);
    }

    public function someUser(array $attributes = [])
    {
        return factory(\App\User::class)->create($attributes);
    }
}
