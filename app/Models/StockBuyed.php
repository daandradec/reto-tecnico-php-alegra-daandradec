<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBuyed extends Model
{
    use HasFactory;
    
    /* TABLA ASOCIADA */
    protected $table = 'stock_amount_buyed';
    
    /* PERMISO DE ASIGNACION MASIVA A TODAS LAS COLUMNAS */
    public $guarded = [];

    /* METODO DE LA RELACION CON INGREDIENTES */
    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }

    /* METODO DE LA RELACION CON STOCKRECEIPT */
    public function receipt(){
        return $this->belongsTo(StockReceipt::class, 'stock_receipt_id');
    }
}
