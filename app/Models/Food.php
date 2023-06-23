<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    /* TABLA ASOCIADA */
    protected $table = 'foods';

    /* PERMISO DE ASIGNACION MASIVA A TODAS LAS COLUMNAS */  
    public $guarded = [];

    /* NO AGREGAR TIMESTAMPS */
    public $timestamps = false;

    /* CAMPOS QUE SIEMPRE SE INYECTARAN A TODOS LOS MODELOS FOOD */
    protected $appends = ['ingredients'];

    /* MUTATOR QUE DEFINE COMO SE OBTENDRA EL ATRIBUTO INGREDIENTS MEDIANTE LA RELACIÓN */
    public function getIngredientsAttribute(){
        return $this->ingredients()->get()->all();
    }

    /* METODO DE LA RELACION CON INGREDIENTES */
    public function ingredients(){
        return $this->belongsToMany(Ingredient::class, 'foods_ingredients', 'food_id', 'ingredient_id');
    }

    /* METODO DE LA RELACION CON ORDENES */
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
