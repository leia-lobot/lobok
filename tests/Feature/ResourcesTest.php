<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResourcesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function an_administrator_can_add_a_resource()
    {
        $this->withoutExceptionHandling();
        // Arrange

        $this->actAsUserWithRole('admin');

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
        $this->actAsUserWithRole('manager');

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
        $this->actAsUserWithRole('employer');

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
        $this->actAsUserWithRole('admin');

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
        $this->actAsUserWithRole('employer');
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
        $this->actAsUserWithRole('admin');

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
        $this->actAsUserWithRole('employer');

        $resource = factory('App\Resource')->create([
            'name' => 'Fubar',
        ]);

        // Act
        $this->delete($resource->path())->assertForbidden();

        // Assert
        $this->assertDatabaseHas('resources', ['name' => $resource->name]);
    }

    /** @test */
    public function a_manager_can_view_a_resource()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole('manager');

        $resource = factory('App\Resource')->create([
            'name' => 'Fubar',
        ]);

        // Act
        $this->get($resource->path())->assertSee($resource->name);
    }

    /** @test */
    public function a_manager_can_list_all_resources()
    {
        $this->withoutExceptionHandling();

        $this->actAsUserWithRole('manager');

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
