<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actAsUserWithRole($role, $extra = null)
    {
        $role = Role::create(['name' => $role]);

        if (is_null($extra)) {
            $user = factory('App\User')->create(['company_id' => factory('App\Company')]);
        } else {
            $user = factory('App\User')->create($extra);
        }

        $user->assignRole($role);
        $this->actingAs($user);
    }
}
