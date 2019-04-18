<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Google;

class GoogleClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_connect_to_google_calendar()
    {
        $gc = new Google();
        $service = $gc->service("Calendar");
        dd($service);
    }
}
