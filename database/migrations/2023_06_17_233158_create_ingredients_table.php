<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TABLA DE INGREDIENTES
     * - ID
     * - KEY: llave unica en string como el nombre el minusculas para busquedas si no disponemos del id
     * - NAME: nombre del ingrediente en string
     * - AMOUNT: cantidad que se tienen del ingrediente en entero
     */
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('ingredient_key');
            $table->string('ingredient_name');
            $table->smallInteger('ingredient_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
