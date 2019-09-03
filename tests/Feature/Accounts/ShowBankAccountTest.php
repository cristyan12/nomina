<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class ShowBankAccountTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        
        $this->withoutExceptionHandling();
    }

    /** 
     * @testdox Un usuario puede cargar la página del listado
     * @test
    */
    function a_user_can_load_the_index_page()
    {
        $accounts = factory('App\Account', 3)->create();

        $response = $this->actingAs($this->someUser())
            ->get(route('accounts.index'))
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
     * @test 
     * @testdox Un usuario puede cargar la página de detalle de la cuenta bancaria
    */
    function a_user_can_view_the_details_page_of_bank_accounts()
    {
        $account = factory('App\Account')->create();
        $employee = factory('App\Employee')->create();
        $profile = factory('App\EmployeeProfile')->create(['employee_id' => $employee->id]);

        $response = $this->actingAs($this->someUser())
            ->get(route('accounts.show', $account))
            ->assertOk()
            ->assertViewIs('accounts.show')
            ->assertViewHas('account')
            ->assertSee($account->bank->name)
            ->assertSee($account->type)
            ->assertSee($account->number)
            ->assertSee($account->auth1->full_name)
            ->assertSee($account->user->name);
    }
}
