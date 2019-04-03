<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Role\UserRole;

class ReservationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_employee_can_create_a_reservation()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYEE);

        $resource = factory('App\Resource')->create();

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            'resource_id' => $resource->id,
            'start_time' => now(),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/reservations', $attributes);

        $this->assertDatabaseHas('reservations', $attributes);
    }

    /** @test */
    public function a_reservation_requires_a_company()
    {
        //$this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYEE, []);

        $resource = factory('App\Resource')->create();

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            'resource_id' => $resource->id,
            'start_time' => now(),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/reservations', $attributes)->assertStatus(403);

        $this->assertDatabaseMissing('reservations', $attributes);
    }

    /** @test */
    public function a_booking_requires_a_resource()
    {
        //$this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYEE);
        //$resource = factory('App\Resource')->create();

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            //'resource_id' => $resource->id,
            'start_time' => now(),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/reservations', $attributes)->assertSessionHasErrors('resource_id');

        $this->assertDatabaseMissing('reservations', $attributes);
    }

    /** @test */
    public function a_booking_has_to_be_in_the_future()
    {
        //$this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYEE);

        $resource = factory('App\Resource')->create();

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            'resource_id' => $resource->id,
            'start_time' => now()->subDay(5),
            'end_time' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/reservations', $attributes)->assertSessionHasErrors('start_time');

        $this->assertDatabaseMissing('reservations', $attributes);
    }

    /** @test */
    public function a_bookings_end_time_must_be_after_start_time()
    {
        //$this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYEE);

        $resource = factory('App\Resource')->create();

        $attributes = [
            'title' => 'Hodorton',
            'description' => 'Hodor speaks',
            'resource_id' => $resource->id,
            'start_time' => now(),
            'end_time' => now()->subHour(2),
        ];

        // a user can create a company
        $this->post('/reservations', $attributes)->assertSessionHasErrors('end_time');

        $this->assertDatabaseMissing('reservations', $attributes);
    }
}
