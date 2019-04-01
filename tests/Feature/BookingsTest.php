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
        $resource = factory('App\Resource')->create();
        $company = factory('App\Company')->create();

        $this->actingAs($user);

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            'resource_id' => $resource->id,
            'company_id' => $company->id,
            'start_time' => now(),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/bookings', $attributes)->assertRedirect('/bookings');

        $this->assertDatabaseHas('bookings', $attributes);

        $this->get('/bookings')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_booking_requires_a_company()
    {
        //$this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        $resource = factory('App\Resource')->create();
        //$company = factory('App\Company')->create();

        $this->actingAs($user);

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            'resource_id' => $resource->id,
            //'company_id' => $company->id,
            'start_time' => now(),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/bookings', $attributes)->assertSessionHasErrors('company_id');

        $this->assertDatabaseMissing('bookings', $attributes);
    }

    /** @test */
    public function a_booking_requires_a_resource()
    {
        //$this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        //$resource = factory('App\Resource')->create();
        $company = factory('App\Company')->create();

        $this->actingAs($user);

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            //'resource_id' => $resource->id,
            'company_id' => $company->id,
            'start_time' => now(),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/bookings', $attributes)->assertSessionHasErrors('resource_id');

        $this->assertDatabaseMissing('bookings', $attributes);
    }

    /** @test */
    public function a_booking_has_to_be_in_the_future()
    {
        //$this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        $resource = factory('App\Resource')->create();
        $company = factory('App\Company')->create();

        $this->actingAs($user);

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            'resource_id' => $resource->id,
            'company_id' => $company->id,
            'start_time' => now()->subDay(5),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/bookings', $attributes)->assertSessionHasErrors('start_time');

        $this->assertDatabaseMissing('bookings', $attributes);
    }

    /** @test */
    public function a_bookings_end_time_must_be_after_start_time()
    {
        //$this->withoutExceptionHandling();

        $user = factory('App\User')->create();
        $resource = factory('App\Resource')->create();
        $company = factory('App\Company')->create();

        $this->actingAs($user);

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            'resource_id' => $resource->id,
            'company_id' => $company->id,
            'start_time' => now(),
            'end_time' => now()->subHour(2),
        ];

        // a user can create a company
        $this->post('/bookings', $attributes)->assertSessionHasErrors('end_time');

        $this->assertDatabaseMissing('bookings', $attributes);
    }
}
