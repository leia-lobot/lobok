<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_booking()
    {
        $this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        $resource = factory('App\Room')->create();
        $company = factory('App\Company')->create();
        //$extras = factory('App\Extras', 3)->create();

        $this->actingAs($user);

        $attributes = [
            'resource_id' => $resource->id,
            'company_id' => $company->id,
            'user_id' => $user->id,
            'start_time' => now(),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/bookings', $attributes)->assertRedirect('/bookings');

        $this->assertDatabaseHas('bookings', $attributes);

        //$this->get('/bookings')->assertSee($attributes['name']);
    }
}
