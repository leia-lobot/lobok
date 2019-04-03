<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actAsUserWithRole($role)
    {
        $user = factory('App\User')->create()->addRole($role);
        $this->actingAs($user);
    }
}
