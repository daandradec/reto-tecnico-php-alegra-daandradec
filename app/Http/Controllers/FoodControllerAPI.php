<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodControllerAPI extends Controller
{
    /* MOSTRAR TODAS LAS COMIDAS */
    public function indexFoods() { 
        return response()->json(Food::all()); 
    }
}
