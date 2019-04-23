<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{Bank, Employee, Position};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankTest extends TestCase
{
    use RefreshDatabase;

    protected $attributes;

    public function setUp()
    {
        parent::setUp();

        $this->actingAs($this->someuser());

        $firstSignPosition = $this->create(Position::class, ['name' => 'Presidente']);
        $secondSignPosition = $this->create(Position::class, ['name' => 'Vice-Presidente']);

        $firstEmployee = $this->create(Employee::class);
        $secondEmployee = $this->create(Employee::class);

        $this->attributes = [
            'code' => '0102',
            'name' => 'Banco de Venezuela',
            'account' => '01020471120000001234',
            'account_type' => 'Corriente',
            'description' => 'Cuenta matriz de la empresa en el Banco de Venezuela',
            'first_sign_auth' => $firstEmployee->id,
            'first_sign_position' => $firstSignPosition->id,
            'second_sign_auth' => $secondEmployee->id,
            'second_sign_position' => $secondSignPosition->id
        ];;
    }

    /** @test */
    function it_show_a_message_when_no_records_yet()
    {
        $response = $this->get(route('banks.index'))
            ->assertStatus(200)
            ->assertSee('No hay bancos registrados aún.');
    }

    /** @test */
    function a_user_can_create_a_bank_of_the_company()
    {
        $response = $this->actingAs($this->someUser())
            ->post(route('banks.store'), $this->attributes)
            ->assertRedirect(route('banks.index'));

        $this->assertDatabaseHas('banks', $this->attributes);
    }

    /** 
    * @test
    * @testdox Un usuario puede cargar la página de los detalles de un banco 
    */
    function a_user_can_show_the_details_page_of_bank()
    {
        $this->withoutExceptionHandling();

        $bank = $this->create(Bank::class, $this->attributes);

        $response = $this->get(route('banks.show', $bank))
            ->assertOk()
            ->assertViewIs('banks.show')
            ->assertViewHas('bank')
            ->assertSee($bank->name)
            ->assertSee($bank->account_type)
            ->assertSee($bank->description);
    }
}
