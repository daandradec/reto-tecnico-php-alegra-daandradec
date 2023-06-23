<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TABLA STOCK COMPRADO
     * - ID
     * - AMOUNT: cantidad del ingrediente que se compro
     * - ingredient_id: id del ingrediente que se compro
     * - stock_receipt_id: id de la factura a la que pertenece
     */
    public function up(): void
    {
        Schema::create('stock_amount_buyed', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('stock_amount');
            $table->integer('ingredient_id');
            $table->integer('stock_receipt_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_amount_buyed');
    }
};
