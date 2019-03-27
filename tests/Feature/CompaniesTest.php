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

        $this->get('/companies')->assertSee($attributes['name']);
    }

    /** @test */
    public function a_user_can_view_a_company()
    {
        $this->withoutExceptionHandling();

        $company = factory(Company::class)->create();

        $this->get($company->path())
            ->assertSee($company->name);
    }

    /** @test */
    public function a_company_requires_a_name()
    {
        $attributes = factory(Company::class)->raw(['name' => '']);

        $this->post('/companies', $attributes)->assertSessionHasErrors('name');
    }

    // /** @test */
    // public function a_company_requires_an_owner()
    // {
    //     $attributes = factory(Company::class)->raw();

    //     $this->post('/companies', $attributes)->assertSessionHasErrors('owner');
    // }
}
