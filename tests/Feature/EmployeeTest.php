<?php

namespace Tests\Feature;

use Database\Seeders\ReferenceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_empoloyee_name_min_2_charaters()
    {
        $response = $this->postJson('/api/employees', [
            'name' => 'a',
            'salary' => 1000000,
        ]);

        $response->assertStatus(422)
            ->assertSeeText('The name must be at least 2 characters.');
    }

    public function test_employee_already_exists()
    {
        $this->postJson('/api/employees', [
            'name' => 'John Doe',
            'salary' => 10000000,
        ]);

        $response = $this->postJson('/api/employees', [
            'name' => 'John Doe',
            'salary' => 10000000,
        ]);

        $response->assertStatus(422)
            ->assertSeeText('The name has already been taken.');
    }

    public function test_employee_salary_invalid()
    {
        $response = $this->postJson('/api/employees', [
            'name' => 'John Doe',
            'salary' => 1000,
        ]);

        $response->assertStatus(422)
            ->assertSeeText('The salary must be between 2000000 and 10000000.');
    }

    public function test_employee_store_success()
    {
        $response = $this->postJson('/api/employees', [
            'name' => 'Test Employee',
            'salary' => 2000000,
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'salary',
                'created_at',
                'updated_at',
            ],
        ]);

    }

}
