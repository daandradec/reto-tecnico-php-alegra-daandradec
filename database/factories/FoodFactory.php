<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_key' => $this->faker->unique()->word, // LLAVE UNICA PARA LA COMIDA
            'food_name' => $this->faker->word, // NOMBRE PARA LA COMIDA
            'food_path_img' => $this->faker->imageUrl, // URL FOTO DE LA COMIDA
        ];
    }
}
