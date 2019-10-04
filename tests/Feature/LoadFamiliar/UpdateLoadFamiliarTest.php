<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\{DatabaseTransactions, RefreshDatabase};

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
}
