<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_load_the_new_contract_page()
    {
        $response = $this->actingAs($this->someUser())
            ->get(route('contracts.create'))
            ->assertStatus(200)
            ->assertViewIs('contracts.create')
            ->assertSee('Tipos de contrato');
    }

    /** @test */
    function a_user_can_create_a_new_contract()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->someUser())
            ->post(route('contracts.store'), [
                'type' => 'INDEFINIDO',
                'duration' => 'Indefinido',
            ])
            ->assertRedirect(route('contracts.index'));

        $this->assertDatabaseHas('contracts', [
            'type' => 'INDEFINIDO',
            'duration' => 'Indefinido',
        ]);
    }

    /** @test */
    function a_user_can_see_a_lists_of_contracts()
    {
        $contracts = factory(\App\Contract::class, 10)->create([
            'type' => 'INDEFINIDO'
        ]);

        $response = $this->actingAs($this->someUser())
            ->get(route('contracts.index'))
            ->assertViewIs('contracts.index')
            ->assertViewHas('contracts');

        foreach ($contracts as $contract) {
            $response->assertSee(e($contract->type));
        }
    }

    /** @test */
    function the_field_type_is_required()
    {
        $this->actingAs($this->someUser())
            ->from(route('contracts.index'))
            ->post(route('contracts.store'), [
                'type' => '',
                'duration' => 'Indefinido',
            ])
            ->assertRedirect(route('contracts.store'))
            ->assertSessionHasErrors(['type']);

        $this->assertEquals(0, \App\Contract::count());
    }
}
