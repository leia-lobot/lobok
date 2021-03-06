<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Reservation\State;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_reservation_has_a_creator()
    {
        $user = factory('App\User')->create();

        $booking = factory('App\Reservation')->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $booking->user->id);
    }

    /** @test */
    public function a_reservation_requires_a_company()
    {
        $company = factory('App\Company')->create();
        $booking = factory('App\Reservation')->create(['company_id' => $company->id]);

        $this->assertEquals($company->id, $booking->company->id);
    }

    /** @test */
    public function a_reservation_requires_a_resource()
    {
        $resource = factory('App\Resource')->create(['name' => 'Luminara']);
        $booking = factory('App\Reservation')->create(['resource_id' => $resource->id]);

        $this->assertEquals($resource->name, $booking->resource->name);
    }

    /** @test */
    public function a_reservation_is_pending_as_default_state()
    {
        $resource = factory('App\Resource')->create([
            'name' => 'Luminara'
        ]);
        $reservation = factory('App\Reservation')->create([
            'resource_id' => $resource->id
        ]);

        $this->assertEquals(State::STATE_PENDING, $reservation->state);
    }

}
