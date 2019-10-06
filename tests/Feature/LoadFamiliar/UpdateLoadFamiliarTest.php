<?php

namespace Tests\Feature\Feature;

use App\LoadFamiliar;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};
use Tests\TestCase;

class UpdateLoadFamiliarTest extends TestCase
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
    * @testdox Se puede ver la pagina de edición de las cargas familiares
    */
    function a_user_can_show_the_edit_page_of_familiar()
    {
        $employee = $this->create('App\Employee', [
            'first_name' => 'Cristyan Josuan',
            'last_name' => 'Valera Rodriguez'
        ]);

        $familiar = $this->create('App\LoadFamiliar', [
            'employee_id' => $employee->id,
            'name' => 'Crismely Sarai Valera Garcia'
        ]);

        $response = $this->get(route('familiars.edit', $familiar))
            ->assertOk()
            ->assertViewIs('familiars.edit')
            ->assertViewHas('familiar', function ($viewFamiliar) use ($familiar) {
                return $viewFamiliar->id === $familiar->id;
            })
            ->assertSee('Cristyan Josuan Valera Rodriguez')
            ->assertSee('Crismely Sarai Valera Garcia');
    }

    /**
    * @test
    * @testdox Se puede actualizar los datos de las cargas familiares
    */
    function a_user_can_update_a_load_familiar()
    {
        $this->withoutExceptionHandling();

        $familiar = $this->create('App\LoadFamiliar');

        $response = $this->put(route('familiars.update', $familiar),
            $this->withData([
                'name' => 'Crismely Valera',
            ]))
            ->assertRedirect($familiar->url());

        $this->assertDatabaseHas('load_familiars', [
            'user_id' => $this->user->id,
            'name' => 'Crismely Valera',
        ]);
    }

    /**
    * @test
    * @testdox El nombre del familiar es obligatorio cuando se actualiza
    */
    function the_name_of_the_load_familiar_is_required_when_updating()
    {
        $familiar = $this->create('App\LoadFamiliar');

        $response = $this->put(route('familiars.update', $familiar),
            $this->withData(['name' => ''])
        )->assertSessionHasErrors('name');

        $this->assertEquals(1, LoadFamiliar::count());
    }

    /**
    * @test
    * @testdox El parentesco del familiar es obligatorio cuando se actualiza
    */
    function the_relationship_of_the_load_familiar_is_required_when_updating()
    {
        $familiar = $this->create('App\LoadFamiliar');

        $response = $this->put(route('familiars.update', $familiar),
            $this->withData(['relationship' => ''])
        )->assertSessionHasErrors('relationship');

        $this->assertEquals(1, LoadFamiliar::count());
    }

    /**
    * @test
    * @testdox El numero de cedula del familiar es obligatorio cuando se actualiza
    */
    function the_document_of_the_load_familiar_is_required_when_updating()
    {
        $familiar = $this->create('App\LoadFamiliar');

        $this->put(route('familiars.update', $familiar),
            $this->withData(['document' => ''])
        )->assertSessionHasErrors('document');

        $this->assertEquals(1, LoadFamiliar::count());
    }

    /**
    * @test
    * @testdox La cedula de la carga familiar debe ser unica
    */
    function the_document_of_the_load_familiar_must_be_unique_when_updating()
    {
        $this->create('App\LoadFamiliar', ['document' => 'V11223345']);

        $familiar = $this->create('App\LoadFamiliar', ['document' => 'V14996612']);

        $this->put(route('familiars.update', $familiar),
            $this->withData(['document' => 'V11223345'])
        )->assertSessionHasErrors(['document']);

        $familiar = LoadFamiliar::find($familiar->id);
        $this->assertSame('V14996612', $familiar->document);
    }

    /**
    * @test
    * @testdox El genero del familiar es obligatorio cuando se actualiza
    */
    function the_sex_of_the_load_familiar_is_required_when_updating()
    {
        $familiar = $this->create('App\LoadFamiliar');

        $response = $this->put(route('familiars.update', $familiar),
            $this->withData(['sex' => ''])
        )->assertSessionHasErrors('sex');

        $this->assertEquals(1, LoadFamiliar::count());
    }

    /**
    * @test
    * @testdox La fecha de nacimiento del familiar es obligatoria cuando se actualiza
    */
    function the_born_at_of_the_load_familiar_is_required_when_updating()
    {
        $familiar = $this->create('App\LoadFamiliar');

        $response = $this->put(route('familiars.update', $familiar),
            $this->withData(['born_at' => ''])
        )->assertSessionHasErrors('born_at');

        $this->assertEquals(1, LoadFamiliar::count());
    }

    /**
    * @test
    * @testdox La fecha de nacimiento del familiar debe ser una fecha valida cuando se actualiza
    */
    function the_born_at_of_the_load_familiar_must_be_valid_when_updating()
    {
        $familiar = $this->create('App\LoadFamiliar');

        $this->put(route('familiars.update', $familiar),
            $this->withData(['born_at' => 'DATE-NO-VALID'])
        )->assertSessionHasErrors('born_at');

        $this->assertEquals(1, LoadFamiliar::count());
    }

    /**
    * @test
    * @testdox El grado de instruccion del familiar es obligatorio cuando se actualiza
    */
    function the_instruction_of_the_load_familiar_is_required_when_updating()
    {
        $familiar = $this->create('App\LoadFamiliar');

        $response = $this->put(route('familiars.update', $familiar),
            $this->withData(['instruction' => ''])
        )->assertSessionHasErrors('instruction');

        $this->assertEquals(1, LoadFamiliar::count());
    }
}
