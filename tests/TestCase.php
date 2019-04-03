<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actAsUserWithRole($role, $extra = null)
    {
        if (is_null($extra)) {
            $user = factory('App\User')->create(['company_id' => factory('App\Company')])->addRole($role);
        } else {
            $user = factory('App\User')->create($extra)->addRole($role);
        }

        $this->actingAs($user);
    }
}
