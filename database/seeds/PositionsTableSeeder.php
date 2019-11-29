<?php

use App\Position;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::first();
        $user->positions()->createMany([
            ['code' => 'OOO1PRES', 'name' => 'Presidente', 'basic_salary' => '235689.43'],
            ['code' => 'OO2VPRES', 'name' => 'Vice Presidente', 'basic_salary' => '180689.43'],
            ['code' => 'OPEO1', 'name' => 'Perforador', 'basic_salary' => '105324.30'],
            ['code' => 'OEO00', 'name' => 'Encuellador', 'basic_salary' => '93667.92'],
            ['code' => '0OB40', 'name' => 'Obrero de Taladro', 'basic_salary' => '1735.00'],
            ['code' => '0OB0A', 'name' => 'Obrero', 'basic_salary' => '88786.00'],
            ['code' => '0MC0X', 'name' => 'Mecánico Ayudante', 'basic_salary' => '85786.00'],
            ['code' => '0OPCS', 'name' => 'Operador de Control de Sólidos', 'basic_salary' => '85786.00'],
            ['code' => '0OPMA', 'name' => 'Operador de Montacargas', 'basic_salary' => '99996.09'],
            ['code' => '0CH0A', 'name' => 'Chofer A', 'basic_salary' => '96453.43']
        ]);
    }
}
