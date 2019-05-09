<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Invite;
use App\Mail\InviteCreated;
use Spatie\Permission\Models\Role;


class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_invited()
    {
        $this->withoutExceptionHandling();
        $this->actAsUserWithRole('admin');

        // Create Invite //
        $attributes = [
            'email' => 'testasdfing@test.se',
            //'token' => str_random(16),
            'company' => (factory('App\Company')->create())->id,
            'role' => 'employed'
        ];

        Role::create(['name' => 'employed']);

        $this->post('/invite', $attributes);

        $invite = Invite::get()->first();

        $this->assertDatabaseHas('invites', $attributes);
        $this->assertEquals($attributes['email'], $invite->email);
        $this->assertEquals($attributes['company'], $invite->company);
        $this->assertEquals($attributes['role'], $invite->role);

        //Mail::to($invite->email)->send(new InviteCreated($invite));


        // Accept Invite
        $userAttributes = [
            'name' => 'Bengt',
            'token' => $invite->token,
            'email' => $invite->email,
            'password' => 'yodariddaren',
            'password_confirmation' => 'yodariddaren'
        ];

        $this->post('/accept', $userAttributes);

        $this->assertDatabaseMissing('invites', $attributes);
        $this->assertDatabaseHas('users', ['name' => $userAttributes['name']]);
    }
}
