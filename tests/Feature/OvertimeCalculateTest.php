<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Reference;
use App\Models\Setting;
use Database\Seeders\ReferenceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OvertimeCalculateTest extends TestCase
{
    // use RefreshDatabase;

    public function test_overtime_calculate_month_required()
    {
        $response = $this->getJson('/api/overtime-pays/calculate');

        $response->assertStatus(422)
            ->assertSeeText('The month field is required.');
    }

    public function test_overtime_calculate_invalid_date()
    {
        $response = $this->json('GET', '/api/overtime-pays/calculate', [
            'month' => '2021-01-01',
        ]);

        $response->assertStatus(422)
            ->assertSeeText('The month does not match the format Y-m.');
    }

    public function test_overtime_calculate_status_ok()
    {
        $response = $this->json('GET', '/api/overtime-pays/calculate', [
            'month' => '2021-01',
        ]);

        $response->assertStatus(200)
            ->assertSeeText('Calculate overtime successfully');
    }

    public function test_overtime_calculate_success()
    {
        $this->seed(ReferenceSeeder::class);
        //set setting
        Setting::create([
            'key' => 'overtime_method',
            'value' => 1,
        ]);

        Employee::create([
            'name' => 'John Doe',
            'salary' => 2000000,
        ]);

        $this->postJson('/api/overtimes', [
            'employee_id' => Employee::first()->id,
            'date' => '2022-11-01',
            'time_started' => '11:00',
            'time_ended' => '12:00',
        ]);

        $this->postJson('/api/overtimes', [
            'employee_id' => Employee::first()->id,
            'date' => '2021-11-02',
            'time_started' => '11:00',
            'time_ended' => '12:00',
        ]);

        $response = $this->json('GET', '/api/overtime-pays/calculate', [
            'month' => '2021-01',
        ]);

        $response->assertStatus(200)
            ->assertSeeText('Calculate overtime successfully');
    }
}
