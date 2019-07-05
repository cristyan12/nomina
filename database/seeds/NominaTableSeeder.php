<?php

use App\Nomina;
use Illuminate\Database\Seeder;

class NominaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nomina::create([
            'name' => 'Nómina Semanal',
            'type' => 'Semanal',
            'periods' => '52',
        ]);

        Nomina::create([
            'name' => 'Nómina Quincenal',
            'type' => 'Quincenal',
            'periods' => '24',
        ]);

        Nomina::create([
            'name' => 'Nómina Mensual',
            'type' => 'Mensual',
            'periods' => '12',
        ]);

        Nomina::create([
            'name' => 'Nómina Eventuales',
            'type' => 'Otros',
        ]);

        Nomina::create([
            'name' => 'Nómina Confidencial',
            'type' => 'Otros',
        ]);
    }
}
