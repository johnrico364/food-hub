<?php

namespace App\Http\Controllers\API;

use App\Application\Recipes\RegisterRecipes;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIController extends Controller
{
  private RegisterRecipes $registerRecipes;

  public function __construct(RegisterRecipes $registerRecipes)
  {
    $this->registerRecipes = $registerRecipes;
  }

  public function index()
  {
    return response()->json('Hello people...!');
  }
  public function getRecipeType($category)
  {
    $recipes = $this->registerRecipes->findByCategory($category);
    $recipesArray = array_map(fn($recep) => $recep->toArray(), $recipes);

    return response()->json(['data' => $recipesArray], 200);
  }
  public function getRecipeDetails($id)
  {
    $recipe = $this->registerRecipes->findById($id);
    if ($recipe === null) {
      return response()->json(['message' => 'Tool not found'], 404);
    }

    return response()->json(['data' => $recipe->toArray()], 200);
  }
  public function getRecipeCategoryCount()
  {
    $recipeCount = $this->registerRecipes->findAllCategoryCount();

    return response()->json(['category_count' => $recipeCount], 200);
  }
  public function getRecipeCategoryCountByCountry($countryName){
    $recipeCount = $this->registerRecipes->findAllCategoryCountByCountry($countryName);
    
    return response()->json(['category_count' => $recipeCount], 200);
  }
  public function getRecipeCountries()
  {
    $recipeCountries = $this->registerRecipes->findAllCountries();

    return response()->json(['data' => $recipeCountries]);
  }
}


