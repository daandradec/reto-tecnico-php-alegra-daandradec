<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\FoodControllerAPI;
use App\Models\Food;

class FoodControllerAPITest extends TestCase
{
    use RefreshDatabase;    

    public function testIndexFoods()
    {
        /* PETICION GET AL API */
        $response = $this->getJson('/api/foods');

        /* TESTEAR QUE DEVUELVA UN ARRAY CON STATUS 200 */
        $response->assertOk();
        $response->assertJson(Food::all()->toArray());
    }
}
