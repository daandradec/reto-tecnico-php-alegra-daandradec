<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    
    /* TABLA ASOCIADA */
    protected $table = 'ingredients';

    /* PERMISO DE ASIGNACION MASIVA A TODAS LAS COLUMNAS */
    public $guarded = [];

    /* NO AGREGAR TIMESTAMPS */
    public $timestamps = false;
    
    /* METODO DE LA RELACION CON FOOD */
    public function foods(){
        return $this->belongsToMany(Food::class, 'foods_ingredients', 'ingredient_id', 'food_id');
    }
}
