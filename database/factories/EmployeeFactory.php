<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Nomina;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            return [
                'code' => $this->faker->randomNumber,
                'document' => $this->faker->randomNumber,
                'last_name' => $this->faker->lastName,
                'first_name' => $this->faker->firstName,
                'rif' => $this->faker->randomNumber,
                'born_at' => $this->faker->date,
                'civil_status' => $this->faker->randomElement([
                    'Casado/a', 'Soltero/a', 'Divorciado/a', 'Viudo/a'
                ]),
                'sex' => $this->faker->randomElement(['F', 'M']),
                'nationality' => $this->faker->randomElement(['V', 'E']),
                'city_of_born' => $this->faker->city,
                'hired_at' => $this->faker->date,
                'nomina_id' => Nomina::factory(),
                'user_id' => User::factory(),
            ];
    }
}
