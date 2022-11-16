<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingTest extends TestCase
{
    public function test_setting_invalid_key()
    {
        $response = $this->patchJson('/api/settings', [
            'key' => 'invalid_key',
            'value' => 1,
        ]);

        $response->assertStatus(422)
            ->assertSeeText('The selected key is invalid.');

    }

    public function test_setting_invalid_value()
    {
        $response = $this->patchJson('/api/settings',
        [
            'key' => 'overtime_rate',
            'value' => 'invalid_value',
        ]);

        $response->assertStatus(422);
        $response->assertSeeText('The value must be an integer.');
    }

    public function test_setting_update_success()
    {
        $response = $this->patchJson(
            '/api/settings',
            [
                'key' => 'overtime_method',
                'value' => 1,
            ]
        );

        $response->assertStatus(200);
    }
}
