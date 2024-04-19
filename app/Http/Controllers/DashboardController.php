<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order', 'asc')->get();
        $dishes = Dish::with('category')->get(); // Asegúrate de tener la relación 'category' en el modelo Dish
        return view('Dashboard.dashboard', compact('categories', 'dishes'));
    }
}
