<?php

use Illuminate\Database\Seeder;
use App\{Bank, Branch, Department, Employee, EmployeeProfile, Position, Profession, Unit, User};

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $president = new Employee([
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

        $user->employees()->save($president);

        $profile = new EmployeeProfile([
            'profession_id' => Profession::find(4)->id,
            'bank_id' => Bank::first()->id,
            'account_number' => '01010101120010020034',
            'branch_id' => Branch::first()->id,
            'department_id' => Department::first()->id,
            'unit_id' => Unit::first()->id,
            'position_id' => Position::where('name', 'Presidente')->value('id'),
        ]);

        $president->profile()->save($profile);

        $vicePresident = new Employee([
            'code' => '14996612',
            'document' => '14996612',
            'last_name' => 'Garcia',
            'first_name' => 'Yusmely',
            'rif' => 'V-14996612-3',
            'born_at' => date('1981-07-18'),
            'sex' => 'F',
            'city_of_born' => 'Guanare',
            'hired_at' => date('2012-10-30'),
        ]);

        $user->employees()->save($vicePresident);

        $profileVicePresident = new EmployeeProfile([
            'employee_id' => $vicePresident->id,
            'profession_id' => Profession::find(3)->id,
            'bank_id' => Bank::first()->id,
            'account_number' => '01010101120010020035',
            'branch_id' => Branch::first()->id,
            'department_id' => Department::first()->id,
            'unit_id' => Unit::first()->id,
            'position_id' => Position::where('name', 'Vice Presidente')->value('id'),
        ]);

        $vicePresident->profile()->save($profileVicePresident);
    }
}
