<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Role\UserRole;

class ResourcesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function an_administrator_can_add_a_resource()
    {
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory('App\User')->create()->addRole(UserRole::ROLE_ADMIN);
        $this->actingAs($user);

        $attributes = [
            'name' => $this->faker->sentence,
        ];

        // Act
        $this->post('/resources', $attributes)->assertRedirect('/resources');

        // Assert
        $this->assertDatabaseHas('resources', $attributes);
        $this->get('/resources')->assertSee($attributes['name']);
    }

    /** @test */
    public function a_manager_can_add_a_resource()
    {
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory('App\User')->create()->addRole(UserRole::ROLE_MANAGER);
        $this->actingAs($user);

        $attributes = [
            'name' => $this->faker->sentence,
        ];

        // Act
        $this->post('/resources', $attributes)->assertRedirect('/resources');

        // Assert
        $this->assertDatabaseHas('resources', $attributes);
        $this->get('/resources')->assertSee($attributes['name']);
    }

    /** @test */
    public function an_employer_can_not_add_a_resource()
    {
        //$this->withoutExceptionHandling();
        // Arrange
        $user = factory('App\User')->create()->addRole(UserRole::ROLE_EMPLOYER);
        $this->actingAs($user);

        $attributes = [
            'name' => $this->faker->sentence,
        ];

        // Act
        $this->post('/resources', $attributes)->assertForbidden();

        // Assert
        $this->assertDatabaseMissing('resources', $attributes);
    }

    /** @test */
    public function an_administrator_can_edit_a_resource()
    {
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory('App\User')->create()->addRole(UserRole::ROLE_ADMIN);
        $this->actingAs($user);
        $resource = factory('App\Resource')->create([
            'name' => 'Fubar',
        ]);

        $attributes = [
            'name' => $this->faker->title,
        ];

        // Act
        $this->patch($resource->path(), $attributes)->assertRedirect('/resources');

        // Assert
        $this->assertDatabaseHas('resources', $attributes);
        $this->get('/resources')->assertSee($attributes['name']);
    }
}
