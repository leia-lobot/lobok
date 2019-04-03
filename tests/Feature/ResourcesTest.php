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

        $this->actAsUserWithRole(UserRole::ROLE_ADMIN);

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
        $this->actAsUserWithRole(UserRole::ROLE_MANAGER);

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
        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYER);

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
        $this->actAsUserWithRole(UserRole::ROLE_ADMIN);

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

    /** @test */
    public function an_employer_can_not_edit_a_resource()
    {
        //$this->withoutExceptionHandling();
        // Arrange
        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYER);
        $resource = factory('App\Resource')->create([
            'name' => 'Fubar',
        ]);

        $attributes = [
            'name' => $this->faker->title,
        ];

        // Act
        $this->patch($resource->path(), $attributes)->assertForbidden();

        // Assert
        $this->assertDatabaseMissing('resources', $attributes);
    }

    /** @test */
    public function an_administrator_can_delete_a_resource()
    {
        $this->actAsUserWithRole(UserRole::ROLE_ADMIN);

        $resource = factory('App\Resource')->create([
            'name' => 'Fubar',
        ]);

        // Act
        $this->delete($resource->path())->assertRedirect('/resources');

        // Assert
        $this->assertDatabaseMissing('resources', ['name' => $resource->name]);
    }

    /** @test */
    public function an_employer_can_not_delete_a_resource()
    {
        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYER);

        $resource = factory('App\Resource')->create([
             'name' => 'Fubar',
         ]);

        // Act
        $this->delete($resource->path())->assertForbidden();

        // Assert
        $this->assertDatabaseHas('resources', ['name' => $resource->name]);
    }

    /** @test */
    public function a_user_can_view_a_resource()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYEE);

        $resource = factory('App\Resource')->create([
             'name' => 'Fubar',
         ]);

        // Act
        $this->get($resource->path())->assertSee($resource->name);
    }

    /** @test */
    public function a_user_can_list_all_resources()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole(UserRole::ROLE_EMPLOYEE);

        $resource = factory('App\Resource', 5)->create();

        // Act
        $this->get('/resources')
            ->assertSee($resource[0]->name)
            ->assertSee($resource[1]->name)
            ->assertSee($resource[2]->name)
            ->assertSee($resource[3]->name)
            ->assertSee($resource[4]->name);
    }
}
