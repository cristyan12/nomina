<?php

namespace Tests\Feature\Accounts;

use App\Account;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class UpdateAccountTest extends TestCase
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
     * @testdox Un usuario puede cargar la página editar cuentas
     * @test
    */
    function a_user_can_load_the_edit_accounts_page()
    {
        $company = $this->create('App\Company');

        $account = $this->create(Account::class);

        $response = $this->get(route('accounts.edit', $account))
            ->assertOk()
            ->assertViewIs('accounts.edit')
            ->assertViewHas('account')
            ->assertSee($account->bank->name);
    }

    /** 
     * @testdox Un usuario puede editar cuentas
     * @test
    */
    function a_user_can_edit_accounts()
    {
        $this->withoutExceptionHandling();

        $company = $this->create('App\Company');
        $account = $this->create(Account::class);

        $president = $this->create('App\Position', ['name' => 'PRESIDENTE']);
        $vicePresident = $this->create('App\Position', ['name' => 'VICE-PRESIDENTE']);
        $emp = $this->create('App\Employee');
        $emp2 = $this->create('App\Employee');

        $auth1 = $this->create('App\EmployeeProfile', [
            'employee_id' => $emp->id,
            'position_id' => $president->id,
        ]);

        $auth2 = $this->create('App\EmployeeProfile', [
            'employee_id' => $emp2->id,
            'position_id' => $vicePresident->id
        ]);

        $response = $this->put(route('accounts.update', $account), [
            'auth_1' => $auth1->id,
            'auth_2' => $auth2->id,
        ])->assertRedirect(route('accounts.show', $account));

        $this->assertDatabaseHas('accounts', [
            'auth_1' => $auth1->id,
            'auth_2' => $auth2->id, 
        ]);
    }
}
