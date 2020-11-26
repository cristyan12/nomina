<?php

namespace Database\Factories;

use App\Models\{Account, Bank, Company, EmployeeProfile, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => Company::factory(),
            'bank_id' => Bank::factory(),
            'number' => $this->faker->unique()->bankAccountNumber,
            'type' => $this->faker->randomElement(['Ahorro', 'Corriente']),
            'auth_1' => EmployeeProfile::factory(),
            'auth_2' => EmployeeProfile::factory(),
            'user_id' => User::factory(),
        ];
    }
}
