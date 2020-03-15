<?php

namespace Tests\Feature\Companies;

use App\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class UpdateCompanyTest extends TestCase
{
    use RefreshDatabase;

    protected $attributes = [];

    public function setUp(): void
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
     * @testdox Un usuario puede cargar la página de editar una compañia
    */
    function a_user_can_load_the_page_of_edit_a_company()
    {
        $company = $this->create('App\Company');

        $response = $this->get(route('companies.edit', $company))
            ->assertOk()
            ->assertViewIs('companies.edit')
            ->assertSee('Editar Empresa #' . $company->id);
    }

    /**
     * @test
     * @testdox Un usuario puede actualizar una compañia
    */
    function a_user_can_update_a_company()
    {
        $company = $this->create('App\Company');

        $response = $this->put(route('companies.update', $company), $this->attributes)
            ->assertRedirect(route('companies.show', $company));

        $this->assertDatabaseHas('companies', $this->attributes);
    }

    /**
     * @test
     * @testdox El campo "Nombre" es obligatorio cuando se actualiza
    */
    function the_field_name_is_required_when_updated()
    {
        $company = $this->create('App\Company');

        $replace = array_replace($this->attributes, ['name' => '']);

        $this->from(route('companies.edit', $company))
            ->put(route('companies.update', $company), $replace)
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('companies', [
            'name' => 'Acme, Ltd',
        ]);
    }

    /**
     * @test
     * @testdox El campo "Nombre" debe ser único cuando se actualiza
    */
    function the_field_name_must_be_unique_when_updated()
    {
        $this->create('App\Company', ['name' => 'Acme, Ltd']);

        $company = $this->create('App\Company');

        $response = $this->from(route('companies.edit', $company->id))
            ->put(route('companies.update', $company->id), $this->attributes)
            ->assertRedirect(route('companies.edit', $company->id))
            ->assertSessionHasErrors(['name']);

        $this->assertNotSame('Acmem Ltd', $company->name);
    }

    /**
     * @test
     * @testdox El campo "RIF" es obligatorio cuando se actualiza
    */
    function the_field_rif_is_required_when_updating()
    {
        $company = $this->create('App\Company');

        $replace = array_replace($this->attributes, ['rif' => '']);

        $this->from(route('companies.edit', $company))
            ->put(route('companies.update', $company), $replace)
            ->assertSessionHasErrors(['rif']);

        $company = Company::first();
        $this->assertNotSame('J-20009148-7', $company->rif);
    }

    /**
     * @test
     * @testdox El campo "Dirección" es opcional cuando se actualiza
    */
    function the_field_address_is_optional_when_updating()
    {
        $company = $this->create('App\Company');

        $replace = array_replace($this->attributes, ['address' => '']);

        $this->from(route('companies.edit', $company))
            ->put(route('companies.update', $company), $replace);

        $company = Company::first();
        $this->assertNull($company->address);
    }

    /**
     * @test
     * @testdox El campo "Teléfono" es opcional cuando se actualiza
    */
    function the_field_phone_number_is_optional_when_updating()
    {
        $company = $this->create('App\Company');

        $replace = array_replace($this->attributes, ['phone_number' => '']);

        $this->from(route('companies.edit', $company))
            ->put(route('companies.update', $company), $replace);

        $company = Company::first();
        $this->assertNull($company->phone_number);
    }

    /**
     * @test
     * @testdox El campo "Correo" es opcional cuando se actualiza
    */
    function the_field_email_is_optional_when_updating()
    {
        $company = $this->create(Company::class);
        $replace = array_replace($this->attributes, ['email' => '']);

        $response = $this->from(route('companies.edit', $company))
            ->put(route('companies.update', $company), $replace);

        $company = Company::first();
        $this->assertNull($company->email);
    }

    /**
     * @test
     * @testdox El campo "Correo" es opcional cuando se actualiza
    */
    function the_field_city_is_optional_when_updating()
    {
        $company = $this->create(Company::class);
        $replace = array_replace($this->attributes, ['city' => '']);

        $response = $this->from(route('companies.edit', $company))
            ->put(route('companies.update', $company), $replace);

        $company = Company::first();
        $this->assertNull($company->city);
    }
}
