<?php

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
        \DB::table('banks')->insert([
            ['code' => '0101', 'name' => 'Banco Central de Venezuela'],
            ['code' => '0102', 'name' => 'Banco de Venezuela'],
            ['code' => '0104', 'name' => 'Venezolano de Crédito'],
            ['code' => '0105', 'name' => 'Banco Mercantil'],
            ['code' => '0108', 'name' => 'Banco Provincial'],
            ['code' => '0114', 'name' => 'Bancaribe'],
            ['code' => '0115', 'name' => 'Banco Exterior'],
            ['code' => '0116', 'name' => 'Banco Occidental de Descuento'],
            ['code' => '0128', 'name' => 'Banco Caroní'],
            ['code' => '0134', 'name' => 'Banesco'],
            ['code' => '0137', 'name' => 'Banco Sofitasa'],
            ['code' => '0138', 'name' => 'Banco Plaza'],
            ['code' => '0138', 'name' => 'Banco de la Gente Emprendedora'],
            ['code' => '0151', 'name' => 'BFC Banco Fondo Común'],
            ['code' => '0156', 'name' => '100% Banco'],
            ['code' => '0157', 'name' => 'Banco DelSur'],
            ['code' => '0163', 'name' => 'Banco del Tesoro'],
            ['code' => '0166', 'name' => 'Banco Agrícola de Venezuela'],
            ['code' => '0168', 'name' => 'Bancrecer'],
            ['code' => '0169', 'name' => 'MiBanco'],
            ['code' => '0171', 'name' => 'Banco Activo'],
            ['code' => '0172', 'name' => 'Bancamiga'],
            ['code' => '0173', 'name' => 'Banco Internacional de Desarrollo'],
            ['code' => '0174', 'name' => 'Banplus Banco Universal'],
            ['code' => '0175', 'name' => 'Banco Bicentenario del Pueblo'],
            ['code' => '0176', 'name' => 'Banco Espirito Santo'],
            ['code' => '0177', 'name' => 'Banco de la Fuerza Armada Nacional Bolivariana'],
            ['code' => '0190', 'name' => 'Citibank'],
            ['code' => '0191', 'name' => 'Banco Nacional de Crédito'],
        ]);
    }
}
