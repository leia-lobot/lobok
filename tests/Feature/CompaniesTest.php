<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Company;
use App\Role\UserRole;

class CompaniesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_manager_can_create_a_company()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_MANAGER);

        $attributes = [
            'name' => $this->faker->name,
        ];

        // a user can create a company
        $this->post('/companies', $attributes)->assertRedirect('/companies');

        $this->assertDatabaseHas('companies', $attributes);
    }

    /** @test */
    public function an_employer_can_not_create_a_company()
    {
        // $this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYER);

        $attributes = [
            'name' => $this->faker->name,
        ];

        // a user can create a company
        $this->post('/companies', $attributes)->assertForbidden();

        $this->assertDatabaseMissing('companies', $attributes);
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
        $this->actAsUserWithRole(UserRole::ROLE_MANAGER);

        $attributes = [
            'name' => '',
        ];

        $this->post('/companies', $attributes)->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('companies', $attributes);
    }
}
