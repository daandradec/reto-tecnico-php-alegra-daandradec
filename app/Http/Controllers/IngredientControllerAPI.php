<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientControllerAPI extends Controller
{
    /* MOSTRAR TODAS LOS INGREDIENTES */
    public function indexIngredients() { 
        return response()->json(Ingredient::all()); 
    }
}
