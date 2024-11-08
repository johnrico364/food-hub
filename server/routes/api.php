<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// http://127.0.0.1:8000/api/index
Route::get('/index', [APIController::class, 'index']);
Route::get('/recipes/category/{type}', [APIController::class, 'getRecipeType']); //done
Route::get('/recipe_details/{id}', [APIController::class, 'getRecipeDetails']); //done
Route::get('/search', );
Route::get('/category_count', [APIController::class, 'getRecipeCategoryCount']); //done
Route::get('/country/category_count/{country_name}');
Route::get('/country_list', [APIController::class, 'getRecipeCountries']);//done