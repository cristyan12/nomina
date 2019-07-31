<?php

namespace Tests\Feature\Accounts;

use App\Account;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class CreateAccountTest extends TestCase
{
    use DatabaseTransactions;

    protected $attributes = [];

    public function setUp()
    {
        parent::setUp();

        $this->actingAs($this->someUser());

        $this->attributes = [
        ];

        // $this->withoutExceptionHandling();
    }

    /** 
     * @testdox Un usuario puede cargar la página del listado
     * @test
    */
    function a_user_can_load_the_index_page()
    {
        $accounts = factory('App\Account', 3)->create();

        $response = $this->get(route('accounts.index'))
            ->assertOk()
            ->assertViewIs('accounts.index')
            ->assertViewHas('accounts');

        foreach ($accounts as $account) {
            $response->assertSee(e($account->bank->name))
                ->assertSee(e($account->type))
                ->assertSee(e($account->number));
        }
    }

    /** 
     * @testdox Un usuario puede cargar el formulario de creación de cuentas bancarias
     * @test
    */
    function a_user_can_load_the_page_of_the_new_accounts()
    {
        $company = $this->create('App\Company');
        
        $response = $this->get(route('accounts.create'))
            ->assertOk()
            ->assertViewIs('accounts.create')
            ->assertViewHasAll(['banks', 'company', 'auth1', 'auth2']);
    }

    /** 
     * @testdox Un usuario puede crear una nueva cuentas bancaria de la empresa
     * @test
    */
    function a_user_can_create_a_new_bank_account_of_the_company()
    {
        $company = $this->create('App\Company');
        $bank = $this->create('App\Bank');
        $president = $this->create('App\Position', ['name' => 'PRESIDENTE']);
        $vicePresident = $this->create('App\Position', ['name' => 'VICE-PRESIDENTE']);

        $emp = factory('App\Employee')->create();
        
        $auth1 = $this->create('App\EmployeeProfile', [
            'employee_id' => $emp->id,
            'position_id' => $president->id,
        ]);

        $emp2 = factory('App\Employee')->create();
        
        $auth2 = $this->create('App\EmployeeProfile', [
            'employee_id' => $emp2->id,
            'position_id' => $vicePresident->id
        ]);

        $this->actingAs($user = $this->someUser());

        $response = $this->post(route('accounts.store'), [
            // 'company_id' => $company->id,
            'bank_id' => $bank->id,
            'number' => '12345678912345678912',
            'type' => 'Corriente',
            'auth_1' => $auth1->id,
            'auth_2' => $auth2->id,
        ])
        ->assertRedirect('accounts');

        $this->assertDatabaseHas('accounts', [
            'company_id' => $company->id,
            'bank_id' => $bank->id,
            'number' => '12345678912345678912',
            'type' => 'Corriente',
            'auth_1' => $auth1->id,
            'auth_2' => $auth2->id,
            'user_id' => $user->id,
        ]);
    }

    /** 
     * @testdox El Banco es requerido
     * @test
    */
    function the_bank_id_is_required()
    {
        $company = $this->create('App\Company');

        $response = $this->post(route('accounts.store'), [
            'bank_id' => '',
            'number' => '12345678912345678912',
            'type' => 'Corriente',
            'auth_1' => 1,
            'auth_2' => 2,  
        ])
        ->assertSessionHasErrors(['bank_id']);

        $this->assertEquals(0, Account::count());
    }

    /** 
     * @testdox El número de cuenta es requerido
     * @test
    */
    function the_number_is_required()
    {
        $company = $this->create('App\Company');

        $response = $this->post(route('accounts.store'), [
            'bank_id' => '1',
            'number' => '',
            'type' => 'Corriente',
            'auth_1' => 1,
            'auth_2' => 2,  
        ])
        ->assertSessionHasErrors(['number']);

        $this->assertEquals(0, Account::count());
    }

    /** 
     * @testdox El número de cuenta debe ser único
     * @test
    */
    function the_number_must_be_unique()
    {
        $company = $this->create('App\Company');
        $account = $this->create('App\Account', [
            'number' => '12345678912345678912'
        ]);

        $response = $this->post(route('accounts.store'), [
            'bank_id' => '1',
            'number' => $account->number,
            'type' => 'Corriente',
            'auth_1' => 1,
            'auth_2' => 2,  
        ])
        ->assertSessionHasErrors(['number']);

        $this->assertEquals(1, Account::count());
    }

    /** 
     * @testdox El número de cuenta debe ser de 20 caracteres
     * @test
    */
    function the_number_must_be_20_chars()
    {
        $company = $this->create('App\Company');

        $response = $this->post(route('accounts.store'), [
            'bank_id' => '1',
            'number' => '123',
            'type' => 'Corriente',
            'auth_1' => 1,
            'auth_2' => 2,  
        ])
        ->assertSessionHasErrors(['number']);

        $this->assertEquals(0, Account::count());
    }

    /** 
     * @testdox El número de cuenta debe ser de 20 caracteres maximo
     * @test
    */
    function the_number_must_be_20_chars_max()
    {
        $company = $this->create('App\Company');

        $response = $this->post(route('accounts.store'), [
            'bank_id' => '1',
            'number' => '123453321265+89+123123463431374854216342135',
            'type' => 'Corriente',
            'auth_1' => 1,
            'auth_2' => 2,  
        ])
        ->assertSessionHasErrors(['number']);

        $this->assertEquals(0, Account::count());
    }

    /** 
     * @testdox La firma autorizada Nº 1 es requerida
     * @test
    */
    function the_auth_sign_1_is_required()
    {
        $company = $this->create('App\Company');

        $response = $this->post(route('accounts.store'), [
            'bank_id' => '1',
            'number' => '12345679823233232655',
            'type' => 'Corriente',
            'auth_1' => '',
            'auth_2' => 2,  
        ])
        ->assertSessionHasErrors(['auth_1']);

        $this->assertEquals(0, Account::count());
    }
}
