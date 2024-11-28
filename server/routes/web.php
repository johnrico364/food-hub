<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/recipes/store', [RecipeController::class, 'store'])->name('recipes.store');
Route::get('/recipes/update/{id}', [RecipeController::class, 'update'])->name('recipes.update');
Route::post('/recipes/update/store/{id}', [RecipeController::class, 'updateStore'])->name('recipes.update.store');
Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
Route::post('/recipes/restore/{id}', [RecipeController::class, 'restore'])->name('recipes.restore');
Route::get('/settings', [RecipeController::class, 'settings'])->name('settings');
Route::get('/archive', [RecipeController::class, 'archive'])->name('archive');


