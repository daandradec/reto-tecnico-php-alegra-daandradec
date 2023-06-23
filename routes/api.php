<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
USE App\Http\Controllers\FoodControllerAPI;
USE App\Http\Controllers\IngredientControllerAPI;
USE App\Http\Controllers\OrderControllerAPI;
USE App\Http\Controllers\StockControllerAPI;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* ENDPOINT DE FOODS */
Route::get('/foods', [FoodControllerAPI::class, 'indexFoods']);

/* ENDPOINT DE INGREDIENTES */
Route::get('/ingredients', [IngredientControllerAPI::class, 'indexIngredients']);

/* ENDPOINT DE CRUD DE ORDENES */
Route::get('/orders', [OrderControllerAPI::class, 'indexOrders']);
Route::post('/orders', [OrderControllerAPI::class, 'storeOrders']);
Route::put('/orders/{order}', [OrderControllerAPI::class, 'updateOrder']);
Route::patch('/orders/{order}', [OrderControllerAPI::class, 'updateOrder']);

/* ENDPOINT DE CURD DE STOCK */
Route::get('/stocks', [StockControllerAPI::class, 'indexStocks']);
Route::post('/stocks', [StockControllerAPI::class, 'stockBuy']);