<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function someUser(array $attributes = [])
    {
        return factory(\App\User::class)->create($attributes);
    }
}
