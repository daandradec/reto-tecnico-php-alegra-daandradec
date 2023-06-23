<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    /* PERMISO DE ASIGNACION MASIVA DE CAMPOS A CIERTAS COLUMNAS */
    public $fillable = ['order_delivered'];

    /* METODO DE LA RELACION CON FOOD */
    public function food(){
        return $this->belongsTo(Food::class);
    }

    /* MUTATOR QUE DEVUELVE EL ATRIBUTO CREATED_AT DE UTC A HORA COLOMBIANA */
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->subHours(5);
    }
    /* MUTATOR QUE DEVUELVE EL ATRIBUTO UPDATED_AT DE UTC A HORA COLOMBIANA */
    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->subHours(5);
    }    
}
