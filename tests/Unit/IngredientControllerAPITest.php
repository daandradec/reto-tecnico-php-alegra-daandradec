<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\IngredientControllerAPI;
use App\Models\Ingredient;

class IngredientControllerAPITest extends TestCase
{
    use RefreshDatabase;    

    public function testIndexIngredients()
    {
        /* PETICION GET AL API */
        $response = $this->getJson('/api/ingredients');

        /* TESTEAR QUE DEVUELVA UN ARRAY CON STATUS 200 */
        $response->assertOk();
        $response->assertJson(Ingredient::all()->toArray());
    }
}
