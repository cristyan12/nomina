<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $this->attributes = [
            'name' => 'Acme, Ltd',
            'rif' => 'J-20009148-7',
            'address' => '#34, av. Unda',
            'phone_number' => '0257-2513656',
            'email' => 'compañia.23@mail.com',
            'city' => 'Guanare',
        ];

        $this->withoutExceptionHandling();
    }

    /** 
     * @testdox Un usuario registrado puede cargar la página de crear nueva compañia
     * @test 
    */
    function a_user_can_load_the_page_of_create_a_company()
    {
        $response = $this->get(route('companies.create'))
            ->assertOk()
            ->assertViewIs('companies.create')
            ->assertSee('Crear Empresa');
    }

    /** 
     * @testdox Un usuario registrado puede crear una nueva compañia
     * @test 
    */
    function a_user_can_create_a_company()
    {
        $response = $this->post(route('companies.store', $this->attributes))
        ->assertRedirect('companies');

        $this->assertDatabaseHas('companies', $this->attributes);
    }

    /** 
     * @testdox Muestra un mensaje "No hay registros aún" cuando no hay registros
     * @test 
    */
    function it_show_a_message_when_no_records_yet()
    {
        $response = $this->get(route('companies.index'))
            ->assertOk()
            ->assertSee('No hay registros aún');
    }
}
