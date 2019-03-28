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
    }
}
