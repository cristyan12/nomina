<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->shuffleString('O10PE2'),
            'name' => $this->faker->unique()->jobTitle,
            'basic_salary' => $this->faker->randomFloat(2, 0, 10),
            'user_id' => User::factory(),
        ];
    }
}
