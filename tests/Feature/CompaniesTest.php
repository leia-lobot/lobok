<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Company;

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
        $this->post('/companies', $attributes)->assertRedirect('/companies');

        $this->assertDatabaseHas('companies', $attributes);
    }

    /** @test */
    public function a_company_requires_a_name()
    {
        $attributes = factory(Company::class)->raw(['name' => '']);

        $this->post('/companies', $attributes)->assertSessionHasErrors('name');
    }
}
