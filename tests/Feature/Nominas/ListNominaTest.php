<?php

namespace Tests\Feature;

use App\Nomina;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class ListNominaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->be($this->someUser());

        $this->withoutExceptionHandling();
    }

    /**
     *  @test
     *  @testdox Se puede cargar la página de listados de nomina
    */
    function it_load_the_page_of_list_nomina()
    {
        $response = $this->get(route('nomina.index'))
            ->assertOk()
            ->assertViewIs('nomina.index')
            ->assertViewHas('nominas')
            ->assertSee('Nóminas');
    }

    /**
     *  @test
     *  @testdox Se puede cargar la página de detalle de nómina
    */
    function a_user_can_show_a_details_of_nomina()
    {
        $user = $this->someUser();

        $nomina = $this->make(Nomina::class, [
            'name' => 'Nómina Confidencial',
        ]);

        $user->nominas()->save($nomina);

        $response = $this->get(route('nomina.show', $nomina->id))
            ->assertOk()
            ->assertViewIs('nomina.show')
            ->assertViewHas('nomina')
            ->assertSee('Nómina Confidencial')
            ->assertSee($user->name);
    }
}
