<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * SEEDER PARA EL RELLENADO DE LA INFORMACIÓN DE LA BASE DE DATOS CON LOS 9 INGREDIENTES QUE MANEJA LA BODEGA DEL RESTAURANTE Y LAS 6 RECETAS DE PRODUCTOS DE COMIDA
     */
    public function run(): void
    {
        /* BORRADO DE LA INFORMACIÓN DE LA TABLA SIN BORRAR LA TABLA */
        Ingredient::truncate();
        Food::truncate();
        \App\Models\Order::truncate();
        \App\Models\StockReceipt::truncate();
        \App\Models\StockBuyed::truncate();

        /* CREACIÓN DE LOS INGREDIENTES POR DEFECTO DEL SISTEMA */
        Ingredient::create(['ingredient_key' => 'tomato', 'ingredient_name' => 'Tomato', 'ingredient_amount' => 5]);
        Ingredient::create(['ingredient_key' => 'potato', 'ingredient_name' => 'Potato', 'ingredient_amount' => 5]);
        Ingredient::create(['ingredient_key' => 'rice', 'ingredient_name' => 'Rice', 'ingredient_amount' => 5]);
        Ingredient::create(['ingredient_key' => 'ketchup', 'ingredient_name' => 'Ketchup', 'ingredient_amount' => 5]);
        Ingredient::create(['ingredient_key' => 'lettuce', 'ingredient_name' => 'Lettuce', 'ingredient_amount' => 5]);
        Ingredient::create(['ingredient_key' => 'onion', 'ingredient_name' => 'Onion', 'ingredient_amount' => 5]);
        Ingredient::create(['ingredient_key' => 'cheese', 'ingredient_name' => 'Cheese', 'ingredient_amount' => 5]);
        Ingredient::create(['ingredient_key' => 'meat', 'ingredient_name' => 'Meat', 'ingredient_amount' => 5]);
        Ingredient::create(['ingredient_key' => 'chicken', 'ingredient_name' => 'Chicken', 'ingredient_amount' => 5]);

        /* CREACIÓN DE LAS RECETAS DE COMIDA POR DEFECTO DEL SISTEMA */
        Food::create(['food_key' => 'chicken-rice', 'food_name' => 'Chicken Rice', 'food_path_img' => './img/chicken-rice.jpg']);
        Food::create(['food_key' => 'chicken-salad', 'food_name' => 'Chicken Salad', 'food_path_img' => './img/chicken-salad.jpg']);
        Food::create(['food_key' => 'chicken-pizza', 'food_name' => 'Chicken Pizza', 'food_path_img' => './img/chicken-pizza.jpg']);
        Food::create(['food_key' => 'chicken-hamburguer', 'food_name' => 'Chicken Hamburger', 'food_path_img' => './img/chicken-hamburguer.jpg']);
        Food::create(['food_key' => 'meat-hamburguer', 'food_name' => 'Meat Hamburger', 'food_path_img' => './img/meat-hamburguer.jpg']);
        Food::create(['food_key' => 'meat-wrap', 'food_name' => 'Meat Wrap', 'food_path_img' => './img/meat-wrap.jpg']);
        
        /* CREACIÓN DE LAS RELACIONES ENTRE RECETAS E INGREDIENTES */        
        DB::table('foods_ingredients')->insert(['food_id' => 1, 'ingredient_id' => 3]);
        DB::table('foods_ingredients')->insert(['food_id' => 1, 'ingredient_id' => 4]);
        DB::table('foods_ingredients')->insert(['food_id' => 1, 'ingredient_id' => 9]);

        DB::table('foods_ingredients')->insert(['food_id' => 2, 'ingredient_id' => 1]);
        DB::table('foods_ingredients')->insert(['food_id' => 2, 'ingredient_id' => 2]);
        DB::table('foods_ingredients')->insert(['food_id' => 2, 'ingredient_id' => 5]);
        DB::table('foods_ingredients')->insert(['food_id' => 2, 'ingredient_id' => 6]);
        DB::table('foods_ingredients')->insert(['food_id' => 2, 'ingredient_id' => 9]);

        DB::table('foods_ingredients')->insert(['food_id' => 3, 'ingredient_id' => 7]);
        DB::table('foods_ingredients')->insert(['food_id' => 3, 'ingredient_id' => 9]);

        DB::table('foods_ingredients')->insert(['food_id' => 4, 'ingredient_id' => 1]);
        DB::table('foods_ingredients')->insert(['food_id' => 4, 'ingredient_id' => 6]);
        DB::table('foods_ingredients')->insert(['food_id' => 4, 'ingredient_id' => 7]);
        DB::table('foods_ingredients')->insert(['food_id' => 4, 'ingredient_id' => 9]);

        DB::table('foods_ingredients')->insert(['food_id' => 5, 'ingredient_id' => 1]);
        DB::table('foods_ingredients')->insert(['food_id' => 5, 'ingredient_id' => 6]);
        DB::table('foods_ingredients')->insert(['food_id' => 5, 'ingredient_id' => 7]);
        DB::table('foods_ingredients')->insert(['food_id' => 5, 'ingredient_id' => 8]);

        DB::table('foods_ingredients')->insert(['food_id' => 6, 'ingredient_id' => 1]);
        DB::table('foods_ingredients')->insert(['food_id' => 6, 'ingredient_id' => 2]);
        DB::table('foods_ingredients')->insert(['food_id' => 6, 'ingredient_id' => 3]);
        DB::table('foods_ingredients')->insert(['food_id' => 6, 'ingredient_id' => 5]);
        DB::table('foods_ingredients')->insert(['food_id' => 6, 'ingredient_id' => 6]);
        DB::table('foods_ingredients')->insert(['food_id' => 6, 'ingredient_id' => 7]);
        DB::table('foods_ingredients')->insert(['food_id' => 6, 'ingredient_id' => 8]);
        

        // Food::find(1)->orders()->create(['order_delivered' => false]);
        // Food::find(1)->orders()->create(['order_delivered' => true]);
        // Food::find(2)->orders()->create(['order_delivered' => false]);
        // Food::find(3)->orders()->create(['order_delivered' => true]);
        // Food::find(4)->orders()->create(['order_delivered' => false]);
        // Food::find(5)->orders()->create(['order_delivered' => false]);
        // Food::find(6)->orders()->create(['order_delivered' => true]);

        // \App\Models\StockReceipt::create();
        // \App\Models\StockReceipt::create();
        // \App\Models\StockBuyed::create(['stock_receipt_id' => 1, 'ingredient_id' => 1, 'stock_amount' => 2]);
        // \App\Models\StockBuyed::create(['stock_receipt_id' => 1, 'ingredient_id' => 3, 'stock_amount' => 6]);
        // \App\Models\StockBuyed::create(['stock_receipt_id' => 1, 'ingredient_id' => 6, 'stock_amount' => 1]);
        // \App\Models\StockBuyed::create(['stock_receipt_id' => 2, 'ingredient_id' => 9, 'stock_amount' => 0]);
        // \App\Models\StockBuyed::create(['stock_receipt_id' => 2, 'ingredient_id' => 7, 'stock_amount' => 3]);
        // \App\Models\StockBuyed::create(['stock_receipt_id' => 2, 'ingredient_id' => 4, 'stock_amount' => 10]);
    }
}
