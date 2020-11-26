<?php

namespace Database\Factories;

use App\Models\{Concept, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class ConceptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Concept::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(['asignacion', 'deduccion']),
            'description' => $this->faker->text,
            'quantity' => $this->faker->randomFloat(2),
            'calculation_salary' => $this->faker->word,
            'formula' => $this->faker->sentence,
            'user_id' => User::factory(),
        ];
    }
}
