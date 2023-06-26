<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\StockControllerAPI;
use App\Models\StockReceipt;
use App\Models\StockBuyed;
use App\Models\Ingredient;

class StockControllerAPITest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the indexStocks method.
     *
     * @return void
     */
    public function testIndexStocks()
    {
        // Create some sample data
        $receipt = StockReceipt::factory()->create();
        $stockBuyed1 = StockBuyed::factory()->create(['stock_receipt_id' => $receipt->id, 'ingredient_id' => 1, 'stock_amount' => 2]);
        $stockBuyed2 = StockBuyed::factory()->create(['stock_receipt_id' => $receipt->id, 'ingredient_id' => 1, 'stock_amount' => 2]);

        // Make a GET request to the indexStocks endpoint
        $response = $this->get('/api/stocks');

        // Assert the response status code is 200 (OK)
        $response->assertStatus(200);

        // Assert the response contains the expected data
        $response->assertJson([
            [
                'id' => $receipt->id,
                'stock_buyed' => [
                    [
                        'id' => $stockBuyed1->id,
                        // Add other expected attributes of the StockBuyed model
                    ],
                    [
                        'id' => $stockBuyed2->id,
                        // Add other expected attributes of the StockBuyed model
                    ],
                ],
            ],
        ]);
    }

    /**
     * Test the stockBuy method.
     *
     * @return void
     */
    public function testStockBuy()
    {
        // Create a sample ingredient
        $ingredient = Ingredient::factory()->create();
        $amount = 10;

        // Make a POST request to the stockBuy endpoint
        $response = $this->postJson('/api/stocks', [
            'ingredient_id' => $ingredient->id,
            'stock_amount' => $amount,
        ]);

        // Assert the response status code is 200 (OK)
        $response->assertStatus(200);

        // Assert the ingredient amount is updated in the database
        $this->assertEquals($ingredient->ingredient_amount + $amount, $ingredient->fresh()->ingredient_amount);
    }
}
