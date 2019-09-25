<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory('App\User')->create();
        
        auth()->loginUsingId($user->id);

        Company::create([
            'name' => 'Beleriand Services, C.A.',
            'rif' => 'V-14996210-3',
            'address' => 'Calle principal del barrio Buenos Aires, S/N',
            'phone_number' => '+5841205295490',
            'email' => 'contact@beleriandservices.com',
            'city' => 'Guanare',
            'user_id' => $user->id,
        ]);
    }
}
