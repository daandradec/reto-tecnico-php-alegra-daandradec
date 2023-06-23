<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Food;

class OrderControllerAPI extends Controller
{
    /* CONSTRUCTOR QUE DEFINE EL ATRIBUTO MAX COMO EL TOTAL DE FOOD EN LA TABLA */
    public function __construct() {
        $this->max = Food::count();
    }

    /* MOSTRAR TODAS LAS ORDENES */
    public function indexOrders() { 
        return response()->json(Order::all()); 
    }

    /* ALMACENAR UNA ORDEN MEDIANTE LA RELACION CON UN FOOD ALEATORIO */
    public function storeOrders(Request $request){
        Food::find(rand(1, $this->max))->orders()->create(['order_delivered' => false]);
        return response()->noContent();
    }    

    /* ACTUALIZAR UNA ORDEN EN SU ESTADO DE ENTREGADO Y LA CANTIDAD DE INGREDIENTES DISMINUIDO EN 1 */
    public function updateOrder(Request $request, Order $order){        
        $order->update(['order_delivered' => $request->input('order_delivered')]);
        $ingredients = $request->input('ingredients');
        foreach($ingredients as $ingredientParam){
            $ingredient = Ingredient::find($ingredientParam['id']);
            $ingredient->ingredient_amount -= 1;
            $ingredient->save();
        }
        return response()->json($order);
    }    
}
