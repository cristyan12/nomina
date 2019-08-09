<?php

namespace Tests\Feature;

use App\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class CreateCompanyTest extends TestCase
{
    use DatabaseTransactions;

    protected $attributes = [];

    public function setUp()
    {
        parent::setUp();

        $this->be($this->someUser());

        $this->attributes = [
            'name' => 'Acme, Ltd',
            'rif' => 'J-20009148-7',
            'address' => '#34, av. Unda',
            'phone_number' => '0257-2513656',
            'email' => 'compañia.23@mail.com',
            'city' => 'Guanare',
        ];

        // $this->withoutExceptionHandling();
        // $this->handleValidationExceptions();
    }

    /** 
     * @test 
     * @testdox Un usuario registrado puede cargar la página de crear nueva compañia
    */
    function a_user_can_load_the_page_of_create_a_company()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('companies.create'))
            ->assertOk()
            ->assertViewIs('companies.create')
            ->assertSee('Crear Empresa');
    }

    /** 
     * @test 
     * @testdox Un usuario registrado puede crear una nueva compañia
    */
    function a_user_can_create_a_company()
    {
        $this->withoutExceptionHandling();

        $this->be($user = $this->someUser());

        $response = $this->post(route('companies.store', $this->attributes))
            ->assertRedirect('companies');

        $this->assertDatabaseHas('companies', [
            'name' => 'Acme, Ltd',
            'rif' => 'J-20009148-7',
            'address' => '#34, av. Unda',
            'phone_number' => '0257-2513656',
            'email' => 'compañia.23@mail.com',
            'city' => 'Guanare',
            'user_id' => $user->id,
        ]);
    }

    /** 
     * @test 
     * @testdox El campo "Nombre" es obligatorio
    */
    function the_field_name_is_required()
    {
        $replace = array_replace($this->attributes, ['name' => '']);

        $this->from(route('companies.create'))
            ->post(route('companies.store'), $replace)
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(0, Company::count());
    }

    /** 
     * @test 
     * @testdox El campo "Nombre" debe ser único
    */
    function the_field_name_must_be_unique()
    {
        $firstCompany = $this->create('App\Company', [
            'name' => 'Acme, Ltd'
        ]);

        $this->from(route('companies.create'))
            ->post(route('companies.store'), $this->attributes)
            ->assertSessionHasErrors(['name']);

        $this->assertEquals(1, Company::count());
    }

    /** 
     * @test 
     * @testdox El campo "RIF" es obligatorio
    */
    function the_field_rif_is_required()
    {
        $replace = array_replace($this->attributes, ['rif' => '']);

        $this->from(route('companies.create'))
            ->post(route('companies.store'), $replace)
            ->assertSessionHasErrors(['rif']);

        $this->assertEquals(0, Company::count());
    }

    /** 
     * @test 
     * @testdox El campo "Dirección" es opcional
    */
    function the_field_address_is_optional()
    {
        $replace = array_replace($this->attributes, ['address' => null]);

        $response = $this->post(route('companies.store'), $replace)
            ->assertRedirect('companies');

        $this->assertDatabaseHas('companies', [
            'address' => null,
            'phone_number' => '0257-2513656',
        ]);
    }

    /** 
     * @test 
     * @testdox El campo "Teléfono" es opcional
    */
    function the_field_phone_number_is_optional()
    {
        $replace = array_replace($this->attributes, ['phone_number' => null]);

        $response = $this->post(route('companies.store'), $replace)
            ->assertRedirect('companies');

        $this->assertDatabaseHas('companies', [
            'phone_number' => null,
        ]);
    }

    /** 
     * @test 
     * @testdox El campo "Correo" es opcional
    */
    function the_field_email_is_optional()
    {
        $replace = array_replace($this->attributes, ['email' => null]);

        $response = $this->post(route('companies.store'), $replace)
            ->assertRedirect('companies');

        $this->assertDatabaseHas('companies', [
            'email' => null,
        ]);
    }

    /** 
     * @test 
     * @testdox El campo "Correo" es opcional
    */
    function the_field_city_is_optional()
    {
        $replace = array_replace($this->attributes, ['city' => null]);

        $response = $this->post(route('companies.store'), $replace)
            ->assertRedirect('companies');

        $this->assertDatabaseHas('companies', [
            'city' => null,
        ]);
    }
}
