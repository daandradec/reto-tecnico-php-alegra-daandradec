<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ingredient_key' => $this->faker->unique()->word, // LLAVE UNICA PARA EL INGREDIENTE
            'ingredient_name' => $this->faker->word, // NOMBRE PARA EL INGREDIENTE
            'ingredient_amount' => 5, // CANTIDAD DE INGREDIENTE
        ];
    }
}
