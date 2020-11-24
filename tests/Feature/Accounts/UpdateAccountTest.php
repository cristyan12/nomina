<?php

namespace Tests\Feature\Accounts;

use App\Models\Account;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeProfile;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateAccountTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->someUser();

        $this->actingAs($this->user);
    }

    /**
     * @testdox Un usuario puede cargar la página editar cuentas
     * @test
    */
    function a_user_can_load_the_edit_accounts_page()
    {
        $company = $this->create(Company::class);

        $account = $this->create(Account::class);

        $response = $this->get(route('accounts.edit', $account))
            ->assertOk()
            ->assertViewIs('accounts.edit')
            ->assertViewHas('account')
            ->assertSee(e($account->bank->name));
    }

    /**
     * @testdox Un usuario puede editar cuentas
     * @test
    */
    function a_user_can_edit_accounts()
    {
        $company = $this->create(Company::class);
        $account = $this->create(Account::class);

        $president = $this->make(Position::class, ['name' => 'PRESIDENTE']);
        $vicePresident = $this->make(Position::class, ['name' => 'VICE-PRESIDENTE']);

        $this->user->positions()->saveMany([$president, $vicePresident]);

        $auth1 = $this->make(EmployeeProfile::class, ['position_id' => $president->id]);
        $auth2 = $this->make(EmployeeProfile::class, ['position_id' => $vicePresident->id]);

        $emp1 = $this->create(Employee::class);
        $emp2 = $this->create(Employee::class);

        $emp1->profile()->save($auth1);
        $emp2->profile()->save($auth2);

        $response = $this->put(route('accounts.update', $account), [
            'auth_1' => $auth1->id,
            'auth_2' => $auth2->id,
        ])->assertRedirect(route('accounts.show', $account));

        $this->assertDatabaseHas('accounts', [
            'auth_1' => $auth1->id,
            'auth_2' => $auth2->id,
        ]);
    }

    /**
     * @testdox La firma autorizada Nº 1 es requerida cuando se actualiza
     * @test
    */
    function the_auth_sign_1_is_required_when_updating()
    {
        // $this->withoutExceptionHandling();

        $company = $this->create(Company::class);
        $account = $this->create(Account::class);

        $response = $this->from(route('accounts.edit', $account))
            ->put(route('accounts.update', $account), [
                'auth_1' => ''
            ])
            ->assertRedirect(route('accounts.edit', $account))
            ->assertSessionHasErrors(['auth_1']);
    }
}
