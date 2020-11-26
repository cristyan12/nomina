<?php

namespace Database\Factories;

use App\Models\Nomina;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NominaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nomina::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement([
                'Semanal', 'Quincenal', 'Mensual', 'Otros',
            ]),
            'periods' => $this->faker->randomNumber(2),
            'first_period_at' => $this->faker->date(),
            'last_period_at' => $this->faker->date(),
            'user_id' => User::factory(),
        ];
    }
}
