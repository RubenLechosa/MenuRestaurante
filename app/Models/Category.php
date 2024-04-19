<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Definiendo los campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'order',
    ];

    // Relación uno a muchos con Dish
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}

