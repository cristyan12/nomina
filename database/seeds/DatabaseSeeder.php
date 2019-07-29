<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'positions', 'branches', 'departments',
            'units', 'professions', 'banks', 'companies',
            'permissions', 'users', 'nominas', 'employees',
            'employee_profiles',
        ]);

        $this->call(PositionsTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(ProfessionTableSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(NominaTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
