<?php

namespace Database\Factories;

use App\Models\{Employee, LoadFamiliar, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class LoadFamiliarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoadFamiliar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            return [
                'user_id' => User::factory(),
                'employee_id' => Employee::factory(),
                'name' => $this->faker->name,
                'relationship' => $this->faker->randomElement([
                    'Hijo', 'Hija', 'Pareja', 'Madre', 'Padre'
                ]),
                'document' => $this->faker->randomNumber,
                'sex' => $this->faker->randomElement(['M', 'F']),
                'born_at' => $this->faker->date,
                'instruction' => $this->faker->randomElement([
                    'Estudiante', 'Bachiller', 'TSU', 'Licenciado o Ingeniero'
                ]),
                'reference' => $this->faker->sentence,
            ];
    }
}
