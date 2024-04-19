<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MenuController::class, 'index'])->name('menu.index');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/categories/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('/dashboard/categories', [CategoryController::class, 'store'])->name('dashboard.categories.store');
    Route::get('/dashboard/categories/{category}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::put('/dashboard/categories/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::delete('/dashboard/categories/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');

    Route::post('/dashboard/categories/reorder', [CategoryController::class, 'reorder'])->name('dashboard.categories.reorder');


    // Rutas manuales para Platos
    Route::get('/dashboard/dishes/create', [DishController::class, 'create'])->name('dashboard.dishes.create');
    Route::post('/dashboard/dishes', [DishController::class, 'store'])->name('dashboard.dishes.store');
    Route::get('/dashboard/dishes/{dish}/edit', [DishController::class, 'edit'])->name('dashboard.dishes.edit');
    Route::put('/dashboard/dishes/{dish}', [DishController::class, 'update'])->name('dashboard.dishes.update');
    Route::delete('/dashboard/dishes/{dish}', [DishController::class, 'destroy'])->name('dashboard.dishes.destroy');

});

require __DIR__.'/auth.php';
