<?php

namespace Tests\Feature;

use App\Concept;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};

class ConceptTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->actingAs($this->someUser());

        // $this->withoutExceptionHandling();
    }

    /** 
    * @test
    * @testdox Un usuario puede cargar la página de crear un nuevo concepto 
    */
    function a_user_can_load_the_create_page_of_concepts()
    {
        $response = $this->actingAs($user = $this->someUser())
            ->get(route('concepts.create'))
            ->assertOk()
            ->assertViewIs('concepts.create');
    }
    
    /** 
    * @test
    * @testdox Un usuario puede crear un nuevo concepto
    */
    function a_user_can_create_a_new_concept()
    {
        $attributes = [
            'name' => 'Dias trabajados diurnos',
            'type' => 'asignacion',
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

    /** 
    * @test
    * @testdox El campo nombre es obligatorio al crear un nuevo concepto
    */
    function the_name_field_is_required_when_creating_a_new_concept()
    {
        $response = $this->from(route('concepts.create'))
            ->post(route('concepts.store', [
                'name' => '',
                'type' => 'asignacion',
                'description' => 'Dias trabajados diurnos',
                'quantity' => 4,
                'calculation_salary' => 'SB',
                'formula' => 'quantity * daily_salary',
            ]))
            ->assertRedirect(route('concepts.create'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(0, Concept::count());
    }

    /** 
    * @test
    * @testdox El campo nombre debe ser único en la base de datos al crear un nuevo concepto 
    */
    function the_name_field_must_be_unique_when_creating_a_new_concept()
    {
        $this->create(Concept::class, ['name' => 'Dias trabajados diurnos']);

        $response = $this->from(route('concepts.create'))
            ->post(route('concepts.store', [
                'name' => 'Dias trabajados diurnos',
                'type' => 'asignacion',
                'description' => 'Dias trabajados diurnos',
                'quantity' => 4,
                'calculation_salary' => 'SB',
                'formula' => 'quantity * daily_salary',
            ]))
            ->assertRedirect(route('concepts.create'))
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, Concept::count());
    }

    /** 
    * @test
    * @testdox El campo tipo es obligatorio al crear un nuevo concepto 
    */
    function the_type_field_is_required_when_creating_a_new_concept()
    {
        $response = $this->from(route('concepts.create'))
            ->post(route('concepts.store', [
                'name' => 'Dias trabajados diurnos',
                'type' => '',
                'description' => 'Dias trabajados diurnos',
                'quantity' => 4,
                'calculation_salary' => 'SB',
                'formula' => 'quantity * daily_salary',
            ]))
            ->assertRedirect(route('concepts.create'))
            ->assertSessionHasErrors(['type']);

        $this->assertEquals(0, Concept::count());
    }

    /** 
    * @test
    * @testdox El campo tipo debe ser una asignación o una deducción solamente al crear un nuevo concepto 
    */
    function the_type_field_must_be_asignacion_or_deduccion_when_creating_a_new_concept()
    {
        $response = $this->from(route('concepts.create'))
            ->post(route('concepts.store', [
                'name' => 'Dias trabajados diurnos',
                'type' => 'OTRO METODO',
                'description' => 'Dias trabajados diurnos',
                'quantity' => 4,
                'calculation_salary' => 'SB',
                'formula' => 'quantity * daily_salary',
            ]))
            ->assertRedirect(route('concepts.create'))
            ->assertSessionHasErrors(['type']);

        $this->assertEquals(0, Concept::count());
    }

    /** 
    * @test
    * @testdox El campo descripción es obligatorio al crear un nuevo concepto 
    */
    function the_description_field_is_required_when_creating_a_new_concept()
    {
        $response = $this->from(route('concepts.create'))
            ->post(route('concepts.store', [
                'name' => 'Dias trabajados diurnos',
                'type' => 'asignacion',
                'description' => '',
                'quantity' => 4,
                'calculation_salary' => 'SB',
                'formula' => 'quantity * daily_salary',
            ]))
            ->assertRedirect(route('concepts.create'))
            ->assertSessionHasErrors(['description']);

        $this->assertEquals(0, Concept::count());
    }
}
