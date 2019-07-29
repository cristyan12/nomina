<?php

use Illuminate\Database\Seeder;
use App\{Employee, EmployeeProfile, Position};

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emp = Employee::create([
            'code' => '14996210',
            'document' => '14996210',
            'last_name' => 'Valera',
            'first_name' => 'Cristyan',
            'rif' => 'V-14996210-3',
            'born_at' => date('1981-12-21'),
            'sex' => 'M',
            'city_of_born' => 'Guanare',
            'hired_at' => date('2012-08-30'),
        ]);
        
    }
}
