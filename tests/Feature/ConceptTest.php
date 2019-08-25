<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};

class ConceptTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_load_the_create_page_of_concepts()
    {
        $response = $this->actingAs($user = $this->someUser())
            ->get(route('concepts.create'))
            ->assertOk()
            ->assertViewIs('concepts.create');
    }
    
    /** @test */
    function a_user_can_create_a_new_concept()
    {
        $this->withoutExceptionHandling();
        
        $attributes = [
            'name' => 'Dias trabajados diurnos',
            'type' => 'Asignacion',
            'description' => 'Dias trabajados diurnos',
            'quantity' => 4,
            'calculation_salary' => 'SB',
            'formula' => 'quantity * daily_salary',
        ];

        $response = $this->actingAs($user = $this->someUser())
            ->post(route('concepts.store', $attributes))
            ->assertRedirect(route('concepts.index'));

        $this->assertDatabaseHas('concepts', [
            'name' => $attributes['name'],
            'type' => $attributes['type'],
            'description' => $attributes['description'],
            'quantity' => $attributes['quantity'],
            'calculation_salary' => $attributes['calculation_salary'],
            'formula' => $attributes['formula'],
            'user_id' => $user->id,
        ]);
    }
}
