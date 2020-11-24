<?php

namespace Tests\Feature\Companies;

use App\Models\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions, RefreshDatabase
};

class ShowCompaniesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->be($this->someUser());
    }

    /**
     * @test
     * @testdox Un usuario puede ver el listado de compañias
    */
    function a_user_can_view_the_list_of_companies()
    {
        $companies = factory(Company::class, 10)->create();

        $response = $this->get(route('companies.index'))
            ->assertOk()
            ->assertViewIs('companies.index')
            ->assertViewHas('companies');

        foreach ($companies as $company) {
            $response->assertSee(htmlspecialchars($company->name))
                ->assertSee(e($company->rif));
        }
    }

    /**
     * @test
     * @testdox Un usuario puede cargar la página de detalle de la comañia
    */
    function a_user_can_view_the_details_page_of_companies()
    {
        $this->withoutExceptionHandling();

        $company = $this->create(Company::class, [
            'name' => 'Servicios Beleriand',
            'rif' => 'V-14996210-3',
        ]);

        $response = $this->get(route('companies.show', $company))
            ->assertOk()
            ->assertViewIs('companies.show')
            ->assertViewHas('company')
            ->assertSee(e('Servicios Beleriand'))
            ->assertSee(e('V-14996210-3'));
    }
}
