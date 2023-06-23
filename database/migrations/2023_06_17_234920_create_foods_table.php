<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TABLA FOODS
     * - ID
     * - KEY: llave unica en string como el nombre el minusculas para busquedas si no disponemos del id
     * - NAME: nombre del ingrediente en string
     * - PATH_IMG: RUTA DONDE SE UBICA LA IMAGEN QUE LA REPRESENTA EN EL CONTENIDO PUBLICO
     */
    public function up(): void
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('food_key');
            $table->string('food_name');
            $table->string('food_path_img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
