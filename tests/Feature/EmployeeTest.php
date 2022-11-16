<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

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
