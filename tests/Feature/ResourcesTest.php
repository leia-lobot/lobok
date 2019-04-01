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
        $user = factory('App\User')->create();

        $attributes = [
            'name' => $this->faker->sentence,
        ];

        // Act
        $this->post('/resources', $attributes)->assertRedirect('/resources');

        // Assert
        $this->assertDatabaseHas('resources', $attributes);
        $this->get('/resources')->assertSee($attributes['name']);
    }
     
}
