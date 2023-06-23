<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockReceipt;
use App\Models\StockBuyed;
use App\Models\Ingredient;

class StockControllerAPI extends Controller
{         
    /* MOSTRAR TODAS LAS FACTURAS DE STOCK */
    public function indexStocks() { 
        return response()->json(StockReceipt::with('stockBuyed')->get()); 
    }    

    /* CREAR UNA FACTURA DE STOCK DE COMPRA E INCREMENTAR EL NUMERO DE INGREDIENTES EN INVENTARIO */
    public function stockBuy(Request $request){
        /* SI MANDA UN ID DE LA FACTURA ENTONCES USE ESA INSTANCIA SINO ENTONCES CREELO */
        if($request->filled('receipt_id'))
            $receipt = StockReceipt::find($request->input('receipt_id'));
        else
            $receipt = StockReceipt::create();

        $ingredient_id = $request->input('ingredient_id');
        $stock_amount = $request->input('stock_amount');            
        $receipt->stockBuyed()->create(['ingredient_id' => $ingredient_id, 'stock_amount' => $stock_amount]);
        $ingredient = Ingredient::find($ingredient_id);
        $ingredient->ingredient_amount += $stock_amount;
        $ingredient->save();
        return response()->json(['id' => $receipt->id]);
    }
}
