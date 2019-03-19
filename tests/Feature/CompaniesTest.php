<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompaniesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_company()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->name,
        ];
        // a user can create a company
        $this->post('/companies', $attributes);

        $this->assertStatus(200);
        $this->assertDatabaseHas('companies', $attributes);
    }
}
