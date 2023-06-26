<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/* MODELO DE FACTURAS DE STOCK */
class StockReceipt extends Model
{
    use HasFactory;
    
    /* TABLA ASOCIADA */
    protected $table = 'stock_receipts';

    /* METODO DE LA RELACION CON STOCKBUYED*/
    public function stockBuyed(){
        return $this->hasMany(StockBuyed::class);
    }

    /* MUTATOR QUE DEVUELVE EL ATRIBUTO CREATED_AT DE UTC A HORA COLOMBIANA */
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->subHours(5);
    }    
}
