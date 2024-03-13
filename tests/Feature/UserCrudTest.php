<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Faker\Factory as Faker;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    public function testCreateUser()
    {
        $faker = Faker::create();
        $email = $faker->email;
        $userData = [
            'name' =>  $faker->name,
            'email' => $email,
            'password' => 'password123',
        ];
        $response = $this->post('/api/users', $userData);
        $response->assertStatus(201); // Assert the response status code
        $this->assertDatabaseHas('users', ['email' => $email]); // Assert user exists in the database
    }

    public function testUpdateUser()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johnxxxx@example.com',
            'password' => 'password123',
        ];
        $response = $this->put('/api/users/3', $userData);
        $response->assertStatus(200); // Assert the response status code
        $this->assertDatabaseHas('users', ['email' => 'johnxxxx@example.com']); // Assert user exists in the database
    }

    public function testFindUser()
    {
        $response = $this->get('/api/users/3');
        $response->assertStatus(200);
    }

    public function testGetAllUsers()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }

    public function testDeleteUser()
    {
        $user = User::factory()->create();

        // Act
        $response = $this->delete('/api/users/' . $user->id);

        // Assert
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $response->assertStatus(204);
    }
}
