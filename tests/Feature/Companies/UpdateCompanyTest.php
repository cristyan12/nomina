<?php

namespace Tests\Feature\Companies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class UpdateCompanyTest extends TestCase
{
    use RefreshDatabase;

    protected $attributes = [];

    public function setUp()
    {
        parent::setUp();

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
        $this->handleValidationExceptions();

        $company = $this->create('App\Company');

        $response = $this->put(route('companies.update', $company), $this->attributes)
            ->assertRedirect(route('companies.show', $company));

        $this->assertDatabaseHas('companies', $this->attributes);
    }
}
