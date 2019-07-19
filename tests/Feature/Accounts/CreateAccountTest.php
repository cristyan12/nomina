<?php

namespace Tests\Feature;

use App\Account;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class CreateAccountTest extends TestCase
{
    use RefreshDatabase;

    protected $attributes = [];

    public function setUp()
    {
        parent::setUp();

        $this->be($this->someUser());

        $this->attributes = [
            'company_id' => $this->create('App\Company')->id,
            'bank_id' => $this->create('App\Bank')->id,
            'number' => '12345678901234567891', // 20 digitos *SOLAMENTE*
            'type' => 'Corriente',
            'auth_sign_1' => $this->create('App\Employee')->id, 
            'auth_sign_2' => $this->create('App\Employee')->id,
        ];

        $this->withoutExceptionHandling();
        // $this->handleValidationExceptions();
    }

    /** 
     * @test 
     * @testdox Se muestra un mensaje en pantalla si no hay registros
    */
    function it_show_a_message_when_no_records()
    {
        $response = $this->get(route('accounts.index'))
            ->assertStatus(200)
            ->assertSee('No hay cuentas bancarias registradas aún.');
    }

    /** 
     * @test 
     * @testdox Un usuario puede cargar la página de crear nueva cuenta bancaria
    */
    function a_user_can_load_the_new_the_bank_account_page()
    {
        $company = $this->create('App\Company');
        $auth_sign_1 = $this->create('App\Employee');
        $auth_sign_2 = $this->create('App\Employee');
        $position = $this->create('App\Position');

        $response = $this->get(route('accounts.create'))
            ->assertOk()
            ->assertViewIs('accounts.create')
            ->assertSee('Cuentas bancarias de la empresa')
            ->assertViewHas('companies', function ($companies) use ($company) {
                return $companies->contains($company);
            })
            ->assertViewHas('employees', function ($employees) use ($auth_sign_1, $auth_sign_2) {
                return $employees->contains($auth_sign_1) && $employees->contains($auth_sign_2);
            })
            ->assertViewHas('positions', function ($positions) use ($position) {
                return $positions->contains($position);
            });
    }

    /** 
     * @test 
     * @testdox Un usuario puede crear nueva cuenta bancaria
    */
    function a_user_can_create_a_new_bank_account()
    {
        $response = $this->post(route('accounts.store'), $this->attributes)
            ->assertRedirect(route('accounts.index'));

        $this->assertDatabaseHas('accounts', [
            'company_id' => $this->attributes['company_id'],
            'bank_id' => $this->attributes['bank_id'],
            'number' => '12345678901234567891',
            'type' => 'Corriente',
            'auth_sign_1' => $this->attributes['auth_sign_1'],
            'auth_sign_2' => $this->attributes['auth_sign_2'],
        ]);
    }
}
