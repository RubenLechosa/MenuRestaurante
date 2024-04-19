<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('dashboard')->with('success', 'Categoría creada con éxito.');
    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',  // Validación básica
            'order' => 'required|integer|min:0', // Valida el orden.
        ]);

        // Actualización de la categoría con los datos validados
        $category->update($validatedData);

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Categoría actualizada con éxito');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard');
    }

    public function reorder(Request $request)
{
    foreach ($request->order as $item) {
        $category = Category::find($item['id']);
        $category->order = $item['position'];
        $category->save();
    }

    return response()->json(['success' => true]);
}

}
