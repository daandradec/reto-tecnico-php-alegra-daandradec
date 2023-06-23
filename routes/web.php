<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* RUTA DE HOME */
Route::get('/', function () {
    return view('home', ['count' => App\Models\Order::count() + 1]);
});
/* RUTA DEL DASHBOARD PRINCIPAL */
Route::get('/dashboard', function() {
    return view('dashboard', ['orders' => App\Models\Order::with('food')->orderBy('id', 'desc')->where('order_delivered', false)->get(),'ingredients' => App\Models\Ingredient::all(), 'foods' => App\Models\Food::all()]);
});
/* RUTA DE HISTORIAL DE ORDENES */
Route::get('/history/orders', function () {
    return view('historyOrders', ['orders' => App\Models\Order::with('food')->orderBy('updated_at', 'desc')->where('order_delivered', true)->get()]);
});
/* RUTA DE HISTORIAL DE COMPRAS DE STOCK */
Route::get('/history/stocks', function () {
    return view('historyStock', ['receipts' => App\Models\StockReceipt::with('stockBuyed.ingredient')->orderBy('created_at', 'desc')->get()]);
});