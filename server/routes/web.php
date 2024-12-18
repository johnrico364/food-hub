<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * Public Routes diri like wla pa naka login
 * **/
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [RecipeController::class, 'login'])->name('login');
    Route::post('/validatelogin', [RecipeController::class, 'validateLogin'])->name('validate.login');
});



/**
 * Authenticated Routes
 * **/
Route::group(['middleware' => 'auth'], function () {

    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');

    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes/store', [RecipeController::class, 'store'])->name('recipes.store');

    Route::get('/recipes/update/{id}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::post('/recipes/update/store/{id}', [RecipeController::class, 'updateStore'])->name('recipes.update.store');
    Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

    Route::get('/settings', [RecipeController::class, 'settings'])->name('settings');
    Route::post('/category/update/{id}', [RecipeController::class, 'updateShowCategory'])->name('category.update');
    Route::post('/logout', [RecipeController::class, 'logout'])->name('logout');
    Route::post('/update/admin', [RecipeController::class, 'updateAdmin'])->name('update.admin');

    Route::get('/archive', [RecipeController::class, 'archive'])->name('archive');
    Route::post('/recipes/restore/{id}', [RecipeController::class, 'restore'])->name('recipes.restore');
    Route::delete('/recipes/permanertly/{id}', [RecipeController::class, 'deleteRecipe'])->name('recipes.delete');
});




