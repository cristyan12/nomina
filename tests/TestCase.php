<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $someUser;

    protected function create($class, $attributes = [])
    {
        return factory($class)->create($attributes);
    }

    protected function make($class, $attributes = [])
    {
        return factory($class)->make($attributes);
    }

    protected function someUser(array $attributes = [])
    {
        if ($this->someUser) {
            return $this->someUser;
        }

        return $this->someUser = factory('App\User')->create($attributes);
    }

    public function replaceWithEmptyAttr(array $original, string $attribute)
    {
        return array_replace($original, [$attribute => '']);
    }
}
