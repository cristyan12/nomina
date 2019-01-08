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

    /** @test */
    function the_field_type_must_be_unique()
    {
        $contract = $this->create(\App\Contract::class, [
            'type' => 'INDEFINIDO'
        ]);

        $this->actingAs($this->someUser())
            ->from(route('contracts.index'))
            ->post(route('contracts.store'), [
                'type' => $contract->type,
                'duration' => 'Indefinido',
            ])
            ->assertRedirect(route('contracts.store'))
            ->assertSessionHasErrors(['type']);

        $this->assertEquals(1, \App\Contract::count());
    }

    /** @test */
    function the_field_duration_is_required()
    {
        $this->actingAs($this->someUser())
            ->from(route('contracts.index'))
            ->post(route('contracts.store'), [
                'type' => 'Contrato fijo',
                'duration' => '',
            ])
            ->assertRedirect(route('contracts.store'))
            ->assertSessionHasErrors(['duration']);

        $this->assertEquals(0, \App\Contract::count());
    }

    /** @test */
    function a_user_can_loads_the_contract_details()
    {
        $contract = $this->create(\App\Contract::class, [
            'type' => 'INDEFINIDO'
        ]);

        $response = $this->actingAs($this->someUser())
            ->get(route('contracts.show', $contract))
            ->assertStatus(200)
            ->assertViewIs('contracts.show')
            ->assertViewHas('contract')
            ->assertSee($contract->type);
    }

    /** @test */
    function a_user_can_load_the_edit_page_of_contract()
    {
        $contract = $this->create(\App\Contract::class, [
            'type' => 'INDEFINIDO'
        ]);

        $response = $this->actingAs($this->someUser())
            ->get(route('contracts.edit', $contract))
            ->assertViewIs('contracts.edit')
            ->assertViewHas('contract')
            ->assertSee('Editar tipo de contrato #'. $contract->id);
    }

    /** @test */
    function a_user_can_edit_a_contract()
    {
        $contract = $this->create(\App\Contract::class, [
            'type' => 'INDEFINIDO'
        ]);

        $response = $this->actingAs($this->someUser())
            ->put(route('contracts.update', $contract), [
                'type' => 'TEMPORAL',
                'duration' => 'Hasta cuando quiera'
            ])
            ->assertRedirect(route('contracts.show', $contract));

        $this->assertDatabaseHas('contracts', [
            'type' => 'TEMPORAL',
            'duration' => 'Hasta cuando quiera'
        ]);
    }

    /** @test */
    function the_field_type_is_required_when_updating()
    {
        $contract = $this->create(\App\Contract::class, [
            'type' => 'INDEFINIDO'
        ]);

        $this->actingAs($this->someUser())
            ->from(route('contracts.edit', $contract))
            ->put(route('contracts.update', $contract), [
                'type' => '',
                'duration' => 'Indefinido',
            ])
            ->assertRedirect(route('contracts.edit', $contract))
            ->assertSessionHasErrors(['type']);

        $this->assertEquals(1, \App\Contract::count());
    }

    /** @test */
    function the_field_type_must_be_unique_when_updating()
    {
        $this->create(\App\Contract::class, [
            'type' => 'INDEFINIDO'
        ]);

        $contract = $this->create(\App\Contract::class, [
            'type' => 'TEMPORAL'
        ]);

        $this->actingAs($this->someUser())
            ->from(route('contracts.edit', $contract))
            ->put(route('contracts.update', $contract), [
                'type' => 'INDEFINIDO',
                // 'duration' => 'Hasta que quiera'
            ])
            ->assertRedirect(route('contracts.edit', $contract))
            ->assertSessionHasErrors(['type']);
    }
}
