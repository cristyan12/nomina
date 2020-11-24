<?php

use App\Models\User;
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
        $user = User::first();

        $user->nominas()->createMany([
            ['name' => 'Nómina Semanal', 'type' => 'Semanal', 'periods' => '52'],
            ['name' => 'Nómina Quincenal', 'type' => 'Quincenal', 'periods' => '24'],
            ['name' => 'Nómina Mensual', 'type' => 'Mensual', 'periods' => '12'],
            ['name' => 'Nómina Eventuales', 'type' => 'Otros'],
            ['name' => 'Nómina Confidencial', 'type' => 'Otros'],
        ]);
    }
}
