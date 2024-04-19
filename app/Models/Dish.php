<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    // Definiendo los campos que se pueden asignar masivamente
    protected $fillable = [
        'category_id',   // ID de la categoría a la que pertenece el plato
        'name',    // Hora de inicio del trabajo
        'description',      // Hora de fin del trabajo
        'ingredients',    // Kilómetros recorridos
        'image',
        'price',
        'visible'
    ];

    // Relación muchos a uno con Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

