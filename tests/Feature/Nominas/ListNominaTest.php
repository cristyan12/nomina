<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListNominaTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
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

        $nomina = $this->create('App\Nomina', [
            'name' => 'Nómina Confidencial',
            'user_id' => $user->id,
        ]);

        $response = $this->get(route('nomina.show', $nomina))
            ->assertOk()
            ->assertViewIs('nomina.show')
            ->assertViewHas('nomina')
            ->assertSee('Nómina Confidencial')
            ->assertSee($user->name);
    }
}
