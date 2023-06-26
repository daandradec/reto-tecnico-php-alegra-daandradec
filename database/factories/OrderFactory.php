<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Food;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_delivered' => $this->faker->boolean, // ESTADO DE ENTREGADO O NO
            'food_id' => Food::all()->random()->id, // ID DE LA COMIDA ASOCIADA A LA ORDEN
        ];
    }
}
