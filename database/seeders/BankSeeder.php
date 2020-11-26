<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            Bank::create(['code' => '0001', 'name' => 'Banco Central de Venezuela']),
            Bank::create(['code' => '0102', 'name' => 'Banco de Venezuela']),
            Bank::create(['code' => '0104', 'name' => 'Venezolano de Crédito']),
            Bank::create(['code' => '0105', 'name' => 'Banco Mercantil']),
            Bank::create(['code' => '0108', 'name' => 'Banco Provincial']),
            Bank::create(['code' => '0114', 'name' => 'Bancaribe']),
            Bank::create(['code' => '0115', 'name' => 'Banco Exterior']),
            Bank::create(['code' => '0116', 'name' => 'Banco Occidental de Descuento']),
            Bank::create(['code' => '0128', 'name' => 'Banco Caroní']),
            Bank::create(['code' => '0134', 'name' => 'Banesco']),
            Bank::create(['code' => '0137', 'name' => 'Banco Sofitasa']),
            Bank::create(['code' => '0138', 'name' => 'Banco Plaza']),
            Bank::create(['code' => '0138', 'name' => 'Banco de la Gente Emprendedora']),
            Bank::create(['code' => '0151', 'name' => 'BFC Banco Fondo Común']),
            Bank::create(['code' => '0156', 'name' => '100% Banco']),
            Bank::create(['code' => '0157', 'name' => 'Banco DelSur']),
            Bank::create(['code' => '0163', 'name' => 'Banco del Tesoro']),
            Bank::create(['code' => '0166', 'name' => 'Banco Agrícola de Venezuela']),
            Bank::create(['code' => '0168', 'name' => 'Bancrecer']),
            Bank::create(['code' => '0169', 'name' => 'MiBanco']),
            Bank::create(['code' => '0171', 'name' => 'Banco Activo']),
            Bank::create(['code' => '0172', 'name' => 'Bancamiga']),
            Bank::create(['code' => '0173', 'name' => 'Banco Internacional de Desarrollo']),
            Bank::create(['code' => '0174', 'name' => 'Banplus Banco Universal']),
            Bank::create(['code' => '0175', 'name' => 'Banco Bicentenario del Pueblo']),
            Bank::create(['code' => '0176', 'name' => 'Banco Espirito Santo']),
            Bank::create(['code' => '0177', 'name' => 'Banco de la Fuerza Armada Nacional Bolivariana']),
            Bank::create(['code' => '0190', 'name' => 'Citibank']),
            Bank::create(['code' => '0191', 'name' => 'Banco Nacional de Crédito']),
        ];
    }
}
