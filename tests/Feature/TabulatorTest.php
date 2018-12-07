<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TabulatorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_load_the_creation_of_tabulator_page()
    {
        $this->withoutExceptionhandling();

        $response = $this->actingAs($this->someUser())
            ->get(route('tabulator.create'))
            ->assertStatus(200)
            ->assertViewIs('tabulator.create')
            ->assertSee('Tabulador de pagos CCP 2017-2019')
            ->assertSee('Crear cargo');
    }
}
