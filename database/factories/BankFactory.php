<?php

namespace Database\Factories;

use App\Models\Bank;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bank::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomNumber(4),
            'name' => $this->faker->company,
        ];
    }
}
