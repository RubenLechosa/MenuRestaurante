<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $categories = Category::with(['dishes' => function ($query) {
            $query->where('visible', true);  // Asumiendo que tienes una columna 'visible' en 'dishes'
        }])->orderBy('order', 'asc')->get();

        return view('index', compact('categories'));
    }

}
