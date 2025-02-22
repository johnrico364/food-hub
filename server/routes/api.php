<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIController;

// http://127.0.0.1:8000/api/index
Route::get('/index', [APIController::class, 'index']);
Route::get('/recipes/category/{type}', [APIController::class, 'getRecipeType']); //done
Route::get('/recipe_details/{id}', [APIController::class, 'getRecipeDetails']); //done
Route::get('/search', [APIController::class, 'searchRecipe']); //done
Route::get('/category_count', [APIController::class, 'getRecipeCategoryCount']); //done
Route::get('/country/category_count/{country_name}', [APIController::class, 'getRecipeCategoryCountByCountry']); //done
Route::get('/country_list', [APIController::class, 'getRecipeCountries']);//done
Route::get('/image/{filename}', function ($filename) {
  return response()->file(public_path('images/' . $filename));
}); //done
Route::get('/ingredients_search', [APIController::class, 'ingredientsSearch']); //done