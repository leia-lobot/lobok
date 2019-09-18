<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Reservation\State;
use App\User;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_belong_to_many_companies()
    {
        $user = User::create([
            'name' => 'Dirp',
            'email' => 'user@dirp.se',
            'password' => '12345678'
        ]);

        $company = factory('App\Company');

        $user->joinCompany($company);

        assertTrue($user->companies->contains($company));
        // a_user_can_belong_to_many_companies
    }
}
