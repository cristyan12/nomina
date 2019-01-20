<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{Bank, Employee, Position};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    function it_show_a_message_when_no_records_yet()
    {
        $response = $this->get(route('banks.index'))
            ->assertStatus(200)
            ->assertSee('No hay bancos registrados aún.');
    }

    /** @test */
    function a_user_can_create_a_new_bank()
    {
        $firstSignPosition = $this->create(Position::class, ['name' => 'Presidente']);
        $secondSignPosition = $this->create(Position::class, ['name' => 'Vice-Presidente']);

        $firstEmployee = $this->create(Employee::class);
        $secondEmployee = $this->create(Employee::class);

        $attributes = [
            'code' => '0102',
            'name' => 'Banco de Venezuela',
            'account' => '01020471120000001234',
            'account_type' => 'Corriente',
            'first_sign_auth' => $firstEmployee->id,
            'first_sign_position' => $firstSignPosition->id,
            'second_sign_auth' => $secondEmployee->id,
            'second_sign_position' => $secondSignPosition->id
        ];

        $response = $this->actingAs($this->someUser())
            ->post(route('banks.store'), $attributes)
            ->assertRedirect(route('banks.index'));

        $this->assertDatabaseHas('banks', $attributes);
    }

    // /** @test */
    // function a_user_can_show_the_list_of_banks()
    // {
    //     $this->withoutExceptionHandling();

    //     $banks = factory(Bank::class, 10)->create();

    //     $response = $this->get(route('banks.index'))
    //         ->assertStatus(200);

    //     foreach ($banks as $bank) {
    //         $response->assertSee(e($bank->name))
    //             ->assertSee(e($bank->account))
    //             ->assertSee(e($bank->account_type));
    //     }
    // }
}
