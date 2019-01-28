<?php

use Illuminate\Database\Seeder;

use App\BankOfPay;

class BanksOfPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankOfPay::create([
        	'code' => '0102',
        	'name' => 'Banco de Venezuela'
        ]);

        BankOfPay::create([
        	'code' => '0105',
        	'name' => 'Banco Mercantil'
        ]);

        BankOfPay::create([
        	'code' => '0108',
        	'name' => 'Banco Provincial'
        ]);

        BankOfPay::create([
        	'code' => '0114',
        	'name' => 'BOD'
        ]);

        BankOfPay::create([
        	'code' => '0175',
        	'name' => 'Banco Bicentenario del Pueblo'
        ]);
    }
}
