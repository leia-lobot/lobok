<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_belong_to_one_companies()
    {
        $user = User::create([
            'name' => 'Dirp',
            'email' => 'user@dirp.se',
            'password' => '12345678'
        ]);

        $company = factory('App\Company')->create();

        $user->joinCompany($company);


        $this->assertTrue($user->companies->contains($company));
    }

    /** @test */
    public function a_user_can_belong_to_many_companies()
    {
        $user = User::create([
            'name' => 'Dirp',
            'email' => 'user@dirp.se',
            'password' => '12345678'
        ]);

        $companies = factory('App\Company', 2)->create();

        $user->joinCompany($companies[0]);
        $user->joinCompany($companies[1]);


        $this->assertTrue($user->companies->contains($companies[0]));
        $this->assertTrue($user->companies->contains($companies[1]));
    }
}
