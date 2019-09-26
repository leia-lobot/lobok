<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

use App\Reservation\State;
use App\Company;
use App\Reservation;

class ReservationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_employee_can_create_a_reservation()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole('employee');

        $resource = factory('App\Resource')->create();
        $company = Company::first();

        $attributes = [
            'company_id' => $company->id,
            'resource_id' => $resource->id,
            'start' => now(),
            'end' => now()->addHour(2),
            'request_help' => false
        ];

        $this->post('/reservations', $attributes);

        $this->assertEquals(1, Reservation::count());
    }

    /** @test */
    public function a_reservation_requires_a_company()
    {
        $this->withExceptionHandling();

        $this->actAsUserWithRole('employee', []);

        $resource = factory('App\Resource')->create();

        $attributes = [
            'resource_id' => $resource->id,
            'start' => now(),
            'end' => now()->addHour(2),
            'request_help' => false
        ];

        // a user can create a company
        $this->post('/reservations', $attributes)->assertSessionHasErrors('company_id');

        $this->assertDatabaseMissing('reservations', $attributes);
    }

    /** @test */
    public function a_booking_requires_a_resource()
    {
        $this->withExceptionHandling();

        $this->actAsUserWithRole('employee');
        //$resource = factory('App\Resource')->create();

        $attributes = [
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
        $this->withExceptionHandling();

        $this->actAsUserWithRole('employee');

        $resource = factory('App\Resource')->create();

        $attributes = [
            'resource_id' => $resource->id,
            'start' => now()->subDay(5),
            'end' => now()->addHour(2),
        ];

        // a user can create a company
        $this->post('/reservations', $attributes)->assertSessionHasErrors('start');

        $this->assertDatabaseMissing('reservations', $attributes);
    }

    /** @test */
    public function a_bookings_end_time_must_be_after_start_time()
    {
        $this->withExceptionHandling();

        $this->actAsUserWithRole('employee');

        $resource = factory('App\Resource')->create();

        $attributes = [
            'resource_id' => $resource->id,
            'start' => now(),
            'end' => now()->subHour(2),
        ];

        // a user can create a company
        $this->post('/reservations', $attributes)->assertSessionHasErrors('end');

        $this->assertDatabaseMissing('reservations', $attributes);
    }

    /** @test */
    public function a_manager_can_only_change_to_a_valid_state()
    {
        $this->withExceptionHandling();

        $this->actAsUserWithRole('manager');

        $resource = factory('App\Resource')->create([
            'name' => 'Luminara',
        ]);
        $reservation = factory('App\Reservation')->create([
            'resource_id' => $resource->id,
            'start' => now(),
            'end' => now()->subHour(2),
        ]);

        $this->assertEquals(State::STATE_PENDING, $reservation->state);

        $this->post($reservation->path() . '/state', ['state' => 6])->assertSessionHasErrors('state');

        $this->assertEquals(State::STATE_PENDING, $reservation->fresh()->state);
    }

    /** @test */
    public function a_manager_can_change_reservation_state()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole('manager');

        $resource = factory('App\Resource')->create([
            'name' => 'Luminara',
        ]);
        $reservation = factory('App\Reservation')->create([
            'resource_id' => $resource->id,
            'start' => now(),
            'end' => now()->subHour(2),
        ]);

        $this->assertEquals(State::STATE_PENDING, $reservation->state);

        $this->post($reservation->path() . '/state', ['state' => State::STATE_ACCEPTED]);

        $this->assertEquals(State::STATE_ACCEPTED, $reservation->fresh()->state);
    }

    /** @test */
    public function an_admin_can_change_reservation_state()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole('admin');

        $resource = factory('App\Resource')->create([
            'name' => 'Luminara',
        ]);
        $reservation = factory('App\Reservation')->create([
            'resource_id' => $resource->id,
            'start' => now(),
            'end' => now()->subHour(2),
        ]);

        $this->assertEquals(State::STATE_PENDING, $reservation->state);

        $this->post($reservation->path() . '/state', ['state' => State::STATE_ACCEPTED]);

        $this->assertEquals(State::STATE_ACCEPTED, $reservation->fresh()->state);
    }

    /** @test */
    public function an_employer_can_not_change_reservation_state()
    {
        //$this->withoutExceptionHandling();

        $this->actAsUserWithRole('employer');

        $resource = factory('App\Resource')->create([
            'name' => 'Luminara',
        ]);
        $reservation = factory('App\Reservation')->create([
            'resource_id' => $resource->id,
            'start' => now(),
            'end' => now()->subHour(2),
        ]);

        $this->assertEquals(State::STATE_PENDING, $reservation->state);

        $this->post($reservation->path() . '/state', ['state' => State::STATE_ACCEPTED])->assertForbidden();

        $this->assertEquals(State::STATE_PENDING, $reservation->fresh()->state);
    }

    /** @test */
    public function an_employee_can_update_a_reservation()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole('employee');

        $resource = factory('App\Resource')->create([
            'name' => 'Luminara',
        ]);

        $attributes = [
            'resource_id' => $resource->id,
            'start' => Carbon::parse('2019-09-27 10:14:58'),
            'end' => Carbon::parse('2019-09-27 14:14:58'),
        ];

        $updated = [
            'resource_id' => $resource->id,
            'start' => Carbon::parse('2019-09-26 10:14:58'),
            'end' => Carbon::parse('2019-09-26 14:14:58'),
        ];

        $reservation = factory('App\Reservation')->create($attributes);

        $this->patch($reservation->path(), $updated);

        $this->assertDatabaseHas('reservations', $updated);
    }

    /** @test */
    public function an_employee_can_delete_a_reservation()
    {
        //$this->withoutExceptionHandling();

        $this->actAsUserWithRole('employee');

        $resource = factory('App\Resource')->create([
            'name' => 'Luminara',
        ]);

        $attributes = [
            'resource_id' => $resource->id,
            'start' => now(),
            'end' => now()->addHour(2),
        ];

        $reservation = factory('App\Reservation')->create($attributes);

        $this->delete($reservation->path());

        $this->assertDatabaseMissing('reservations', $attributes);
    }
}
