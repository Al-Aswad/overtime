<?php

namespace Tests\Feature;

use App\Models\Employee;
use Database\Seeders\ReferenceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OvertimeTest extends TestCase
{
    use RefreshDatabase;

   public function test_overtime_invalid_employee_id()
   {
       $response = $this->postJson('/api/overtimes', [
           'employee_id' => 1,
           'overtime_date' => '2021-01-01',
           'overtime_hours' => 1,
       ]);

       $response->assertStatus(422)
           ->assertSeeText('The selected employee id is invalid.');
   }

   public function test_overtime_time_start_must_be_before_time_end()
   {
        Employee::create([
            'name' => 'John Doe',
            'salary' => 2000000,
        ]);

       $response = $this->postJson('/api/overtimes', [
           'employee_id' => Employee::first()->id,
           'date' => '2021-01-01',
           'time_started' => '12:00',
           'time_ended' => '11:00',
       ]);

       $response->assertStatus(422)
           ->assertSeeText('The time ended must be a date after time started.');
   }

   public function test_overtime_employee_has_overtime_on_same_date()
   {
        $this->seed(ReferenceSeeder::class);

        Employee::create([
            'name' => 'John Doe',
            'salary' => 2000000,
        ]);

       $this->postJson('/api/overtimes', [
           'employee_id' => Employee::first()->id,
           'date' => '2021-01-01',
           'time_started' => '11:00',
           'time_ended' => '12:00',
       ]);

       $response = $this->postJson('/api/overtimes', [
           'employee_id' => Employee::first()->id,
           'date' => '2021-01-01',
           'time_started' => '11:00',
           'time_ended' => '12:00',
       ]);

       $response->assertStatus(400)
           ->assertSeeText('Employee already has overtime on this date');
   }
}
