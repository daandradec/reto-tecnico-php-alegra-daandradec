<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TABLA MUCHOS A MUCHOS ENTRE COMIDAS E INGREDIENTES
     * - food_id: llave foranea del id de la comida asociada a que ingrediente
     * - ingredient_id: llave foranea del id del ingrediente asociado a que comida
     */
    public function up(): void
    {
        Schema::create('foods_ingredients', function (Blueprint $table) {
            $table->id();
            $table->integer('food_id');
            $table->integer('ingredient_id');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods_ingredients');
    }
};
