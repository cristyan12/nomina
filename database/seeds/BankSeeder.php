<?php

use Illuminate\Database\Seeder;

use App\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
        	'code' => '0102',
        	'name' => 'Banco de Venezuela'
        ]);

        Bank::create([
        	'code' => '0105',
        	'name' => 'Banco Mercantil'
        ]);

        Bank::create([
        	'code' => '0108',
        	'name' => 'Banco Provincial'
        ]);

        Bank::create([
        	'code' => '0114',
        	'name' => 'BOD'
        ]);

        Bank::create([
        	'code' => '0175',
        	'name' => 'Banco Bicentenario del Pueblo'
        ]);
    }
}
