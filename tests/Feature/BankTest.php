<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    function a_user_can_create_a_new_bank()
    {
        $this->markTestIncomplete();
        return;

        $first_sign_position = $this->create(Position::class, [
            'name' => $this->faker->jobTitle
        ]);

        $second_sign_position = $this->create(Position::class, [
            'name' => $this->faker->jobTitle
        ]);

        $attributes = [
            'code' => '0102', // bank
            'name' => 'Banco de Venezuela', // bank
            'account' => '0102-0471-12-0000001234', // banco - empresa
            'account_type' => 'Corriente', // banco - empresa
            'first_sign_auth' => 'Cristyan Valera', // empleado - empresa
            'first_sign_position' => $first_sign_position->id, // empleado - empresa
            'second_sign_auth' => 'Yusmely Garcia', // empleado - empresa
            'second_sign_position' => $second_sign_position->id, // empleado - empresa
        ];

        $response = $this->actingAs($this->someUser())
            ->post(route('banks.create'), $attributes)
            ->assertRedirect(route('banks.index'));

        $this->assertDatabaseHas('banks', [
            'code' => $attributes['code'],
            'name' => $attributes['name'],
        ]);
    }
}
