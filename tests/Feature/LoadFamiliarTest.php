<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};

class LoadFamiliarTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    protected $user;

    protected $attributes;

    public function setUp()
    {
        parent::setUp();

        $this->user = $this->someUser();

        $this->actingAs($this->user);

        $this->attributes = [
            'employee_id'       => $this->create('App\Employee')->id,
            'name'              => $this->faker->name,
            'relationship'      => $this->faker->randomElement(['Hijo', 'Hija', 'Pareja', 'Madre', 'Padre']),
            'document'          => $this->faker->randomNumber,
            'sex'               => $this->faker->randomElement(['M', 'F']),
            'born_at'           => $this->faker->date,
            'instruction'       => $this->faker->randomElement(['Estudiante', 'Bachiller', 'TSU', 'Licenciado o Ingeniero']),
            'reference'         => $this->faker->sentence,
        ];

        // $this->withoutExceptionHandling();
    }

    /** 
    * @test
    * @testdox Un usuario puede cargar la página de nueva carga familiar de un empleado dado
    */
    function a_user_can_load_the_page_of_the_new_load_familiar_of_a_employee()
    {
        $employee = $this->create('App\Employee');

        $response = $this->get(route('familiars.create', $employee))
            ->assertOk()
            ->assertViewIs('familiars.create')
            ->assertViewHas('employee')
            ->assertSee(e($employee->full_name));
    }

    /** 
    * @test
    * @testdox Un usuario puede registrar una nueva carga familiar de un empleado dado
    */
    function a_user_can_register_a_new_load_familiar_of_a_employee()
    {
        $response = $this->post(route('familiars.store'), $this->attributes)
            ->assertRedirect(route('familiars.index', $this->attributes['employee_id']));

        $this->assertDatabaseHas('load_familiars', [
            'user_id'       => $this->user->id,
            'employee_id'   => $this->attributes['employee_id'],
            'name'          => $this->attributes['name'],
            'relationship'  => $this->attributes['relationship'],
            'document'      => $this->attributes['document'],
            'sex'           => $this->attributes['sex'],
            'born_at'       => $this->attributes['born_at'],
            'instruction'   => $this->attributes['instruction'],
        ]);
    }
}
