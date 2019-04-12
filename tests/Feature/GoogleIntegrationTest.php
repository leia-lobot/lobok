<?php

namespace Tests\Feature;

use Tests\TestCase;

class GoogleIntegrationTest extends TestCase
{
    /** @test */
    public function it_can_fetch_data_from_google_calendar_api()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/google');

        $response->assertStatus(200);
    }
}
