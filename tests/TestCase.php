<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $someUser;

    public function create($class, $attributes = [])
    {
        return factory($class)->create($attributes);
    }

    public function someUser(array $attributes = [])
    {
        if ($this->someUser) {
            return $this->someUser;
        }

        return $this->someUser = factory('App\User')->create($attributes);
    }
}
