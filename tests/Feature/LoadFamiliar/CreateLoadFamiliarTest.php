<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{Employee, LoadFamiliar};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};

class CreateLoadFamiliarTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $attributes;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->someUser();

        $this->actingAs($this->user);

        $this->attributes = [
            'name' => $this->faker->name,
            'relationship' => $this->faker->randomElement([
                'Hijo', 'Hija', 'Pareja', 'Madre', 'Padre'
            ]),
            'document' => $this->faker->randomNumber,
            'sex' => $this->faker->randomElement(['M', 'F']),
            'born_at' => $this->faker->date,
            'instruction' => $this->faker->randomElement([
                'Estudiante', 'Bachiller', 'TSU', 'Licenciado o Ingeniero'
            ]),
            'reference' => $this->faker->sentence,
        ];

        // $this->withoutExceptionHandling();
    }

    /**
    * @test
    * @testdox Un usuario puede cargar la página de nueva carga familiar de un empleado dado
    */
    function a_user_can_load_the_page_of_the_new_load_familiar_of_a_employee()
    {
        $this->withoutExceptionHandling();

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
        $employee = $this->create('App\Employee');

        $response = $this->post(route('familiars.store'),
            $this->withData([
                'employee_id' => $employee->id,
                'user_id' => $this->user->id,
            ]))
            ->assertRedirect(route('familiars.index', $employee->id));

        $this->assertDatabaseHas('load_familiars', [
            'employee_id' => $employee->id,
            'user_id' => $this->user->id,
        ]);
    }

    /**
    * @test
    * @testdox La cedula de la carga familiar debe unica
    */
    function the_document_of_the_load_familiar_must_be_unique()
    {
        // $this->withoutExceptionHandling();

        $familiar1 = $this->create('App\LoadFamiliar', ['document' => 'V11223345']);

        $response = $this->post(route('familiars.store'),
            $this->withData(['document' => 'V11223345'])
        )->assertSessionHasErrors('document');

        $this->assertEquals(1, LoadFamiliar::count());
    }

    /**
    * @test
    * @testdox El ID del empleado es requerido
    */
    function the_employee_id_is_required()
    {
        $response = $this->post(route('familiars.store'), $this->withData(['employee_id' => '']))
            ->assertSessionHasErrors(['employee_id']);

        $this->assertDatabaseMissing('load_familiars', $this->attributes);
    }

    /**
    * @test
    * @testdox El nombre del familiar es requerido
    */
    function the_name_field_is_required()
    {
        $response = $this->post(route('familiars.store'), $this->withData(['name' => '']))
            ->assertSessionHasErrors(['name' => 'El Nombre del familiar es obligatorio']);

        $this->assertDatabaseMissing('load_familiars', $this->attributes);
    }

    /**
    * @test
    * @testdox El parentesco del familiar es requerido
    */
    function the_relationship_field_is_required()
    {
        $response = $this->post(route('familiars.store'), $this->withData(['relationship' => '']))
            ->assertSessionHasErrors(['relationship' => 'El Parentesco del familiar es obligatorio']);

        $this->assertDatabaseMissing('load_familiars', $this->attributes);
    }

    /**
    * @test
    * @testdox La cedula de identidad del familiar es requerido
    */
    function the_familiar_document_field_is_required()
    {
        $response = $this->post(route('familiars.store'), $this->withData(['document' => '']))
            ->assertSessionHasErrors(['document' => 'El Número de cédula del familiar es obligatorio']);

        $this->assertDatabaseMissing('load_familiars', $this->attributes);
    }

    /**
    * @test
    * @testdox El genero sexual del familiar es requerido
    */
    function the_familiar_sex_field_is_required()
    {
        $response = $this->post(route('familiars.store'), $this->withData(['sex' => '']))
            ->assertSessionHasErrors(['sex' => 'El Género del familiar es obligatorio']);

        $this->assertDatabaseMissing('load_familiars', $this->attributes);
    }

    /**
    * @test
    * @testdox La fecha de nacimiento del familiar es requerida
    */
    function the_familiar_born_at_field_is_required()
    {
        $response = $this->post(route('familiars.store'), $this->withData(['born_at' => '']))
            ->assertSessionHasErrors(['born_at' => 'La Fecha de nacimiento del familiar es obligatoria']);

        $this->assertDatabaseMissing('load_familiars', $this->attributes);
    }

    /**
    * @test
    * @testdox La fecha de nacimiento del familiar debe ser una fecha valida
    */
    function the_familiar_born_at_field_must_be_valid_date()
    {
        $response = $this->post(route('familiars.store'), $this->withData([
            'born_at' => 'HOLA_ESTA_ES_UNA_FECHA_ERRADA'
        ]))
        ->assertSessionHasErrors([
            'born_at' => 'La Fecha de nacimiento del familiar debe ser una fecha válida'
        ]);

        $this->assertDatabaseMissing('load_familiars', $this->attributes);
    }

    /**
    * @test
    * @testdox El grado de instruccion del familiar es obligatorio
    */
    function the_familiar_instruction_field_is_required()
    {
        $response = $this->post(route('familiars.store'), $this->withData([
            'instruction' => ''
        ]))
        ->assertSessionHasErrors(['instruction' => 'El Grado de Istrucción del familiar es obligatorio']);

        $this->assertDatabaseMissing('load_familiars', $this->attributes);
    }

    /**
    * @test
    * @testdox Se puede ver la pagina de detalle de las cargas familiares
    */
    function as_user_can_show_the_detail_page_of_familiar()
    {
        $this->withoutExceptionHandling();

        $familiar = $this->create('App\LoadFamiliar');

        $response = $this->get("employees/{$familiar->employee_id}/familiars/{$familiar->id}")
            ->assertOk()
            ->assertViewIs('familiars.show')
            ->assertViewHas('familiar',
                fn($viewFamiliar) => $viewFamiliar->id === $familiar->id)
            ->assertSee(e($familiar->employee->full_name))
            ->assertSee(e($familiar->user->name))
            ->assertSee(e($familiar->name));
    }
}
