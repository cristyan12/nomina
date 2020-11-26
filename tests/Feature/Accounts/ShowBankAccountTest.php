<?php

namespace Tests\Feature\Accounts;

use App\Models\{Account, Employee, EmployeeProfile};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowBankAccountTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
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
        $accounts = Account::factory()->count(3)->create();

        $response = $this->actingAs($this->someUser())
            ->get(route('accounts.index'))
            ->assertOk()
            ->assertViewIs('accounts.index')
            ->assertViewHas('accounts');

        foreach ($accounts as $account) {
            $response->assertSee(htmlspecialchars($account->bank->name))
                ->assertSee(htmlspecialchars($account->type))
                ->assertSee(htmlspecialchars($account->number));
        }
    }

    /**
     * @test
     * @testdox Un usuario puede cargar la página de detalle de la cuenta bancaria
    */
    function a_user_can_view_the_details_page_of_bank_accounts()
    {
        $account = Account::factory()->create();
        $employee = Employee::factory()->create();
        $profile = EmployeeProfile::factory()
            ->create(['employee_id' => $employee->id]);

        $response = $this->actingAs($this->someUser())
            ->get(route('accounts.show', $account))
            ->assertOk()
            ->assertViewIs('accounts.show')
            ->assertViewHas('account')
            ->assertSee(e($account->bank->name))
            ->assertSee(e($account->type))
            ->assertSee(e($account->number))
            ->assertSee(e($account->auth1->full_name))
            ->assertSee(e($account->user->name));
    }
}
