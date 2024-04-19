<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use App\Models\Category;

class DishController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.dishes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'ingredients' => 'string|nullable',
            'image' => 'image|required', // Asegúrate de validar como imagen
            'price' => 'required|numeric',
            'visible' => 'boolean'
        ]);

        $path = $request->file('image')->store('public/images'); // Almacenando el archivo en el sistema de archivos

        $dish = new Dish;
        $dish->category_id = $request->category_id;
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->ingredients = $request->ingredients;
        $dish->image = $path; // Guarda el path de la imagen
        $dish->price = $request->price;
        $dish->visible = $request->visible;
        $dish->save();

        return redirect()->route('dashboard')->with('success', 'Plato creado con éxito.');
    }


    public function edit(Dish $dish)
    {
        $dish = Dish::find($dish->id);
        $categories = Category::all();
        return view('dashboard.dishes.edit', compact('dish', 'categories'));
    }

    public function update(Request $request, Dish $dish)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'string|nullable',
            'ingredients' => 'string|nullable',
            'image' => 'image|nullable',
            'price' => 'required|numeric',
            'visible' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('public/images');
        }

        $dish->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Plato actualizado con éxito');
    }


    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('dashboard');
    }
}
