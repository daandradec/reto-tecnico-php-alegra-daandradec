<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StockReceipt;
use App\Models\Ingredient;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockBuyed>
 */
class StockBuyedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stock_receipt_id' => StockReceipt::all()->random()->id, // ID DE LA FACTURA ASOCIADA
            'ingredient_id' => Ingredient::all()->random()->id, // ID DEL INGREDIENTE ASOCIADO USADO
            'stock_amount' => $this->faker->randomNumber(4) // CANTIDAD DE INGREDIENTE COMPRADO
        ];
    }
}
