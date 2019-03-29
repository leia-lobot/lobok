<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_booking_has_a_creator()
    {
        $user = factory('App\User')->create();

        $booking = factory('App\Booking')->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $booking->user->id);
    }

    /** @test */
    public function a_booking_requires_a_company()
    {
        $company = factory('App\Company')->create();
        $booking = factory('App\Booking')->create(['company_id' => $company->id]);

        $this->assertEquals($company->id, $booking->company->id);
    }

    /*
        'title' => 'Hodorton',
        'description' => 'Hodor speaks',
        'start_time' => now(),
        'end_time' => now()->addHour(2),
    */

    /** @test */
    public function a_booking_requires_a_resource()
    {
        $resource = factory('App\Resource')->create(['name' => 'Luminara']);
        $booking = factory('App\Booking')->create(['resource_id' => $resource->id]);

        $this->assertEquals($resource->name, $booking->resource->name);
    }
}
