<?php

use Illuminate\Database\Seeder;

use App\Models\Profession;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::create(['title' => 'Bachiller']);
        Profession::create(['title' => 'TSU']);
        Profession::create(['title' => 'Licenciado']);
        Profession::create(['title' => 'Ingeniero']);
        Profession::create(['title' => 'Abogado']);
        Profession::create(['title' => 'Médico']);
    }
}
