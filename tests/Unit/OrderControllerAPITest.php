<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\OrderControllerAPI;
use App\Models\Order;
use App\Models\Food;
use App\Models\Ingredient;

class OrderControllerAPITest extends TestCase
{
    use RefreshDatabase;

    public function testIndexOrders()
    {
        // SEDEAR LA BASE DE DATOS CON DATOS DE PRUEBA
        $this->seed();

        $response = $this->getJson('/api/orders');

        /* TESTEAR QUE DEVUELVA UN ARRAY CON STATUS 200 */
        $response->assertOk();
        $response->assertJson(Order::all()->toArray());
    }

    public function testStoreOrders()
    {      
        /* PETICION POST AL API PARA ALMACENAR */  
        $response = $this->postJson('/api/orders');        
        
        /* TESTEAR QUE EN LA BASE DE DATOS ESTE LA COMIDA INSERTADA Y LA ORDEN INSERTADA */
        $this->assertDatabaseHas('foods', ['id' => $response->getContent()]);
        $this->assertDatabaseHas('orders', ['food_id' => $response->getContent(), 'order_delivered' => false]);
    }

    public function testUpdateOrder()
    {
        /* CREAR UNA ORDEN Y 3 INGREDIENTES */
        $order = Order::factory()->create();
        $ingredients = Ingredient::factory()->count(3)->create();

        /* PETICIÓN PUT AL API PARA ACTUALIZAR */
        $response = $this->putJson("/api/orders/{$order->id}", [
            'order_delivered' => true,
            'ingredients' => $ingredients->map(function ($ingredient) {
                return ['id' => $ingredient->id];
            })->toArray(),
        ]);

        /* TESTEAR STATUS 200 DEL REQUEST */
        $response->assertOk();

        /* COMPROBAR QUE EN LA BASE DE DATOS EXISTA LA ORDEN Y LOS INGREDIENTES ACTUALIZADOS */
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'order_delivered' => true]);
        foreach ($ingredients as $ingredient) {
            $this->assertDatabaseHas('ingredients', [
                'id' => $ingredient->id,
                'ingredient_amount' => max(0, $ingredient->ingredient_amount - 1),
            ]);
        }
    }
}