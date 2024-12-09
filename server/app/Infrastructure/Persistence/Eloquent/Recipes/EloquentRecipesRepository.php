<?php

namespace App\Infrastructure\Persistence\Eloquent\Recipes;

use App\Domain\Recipes\RecipesRepository;
use App\Domain\Recipes\Recipes;
use App\Infrastructure\Persistence\Eloquent\Categories\CategoriesModel;

class EloquentRecipesRepository implements RecipesRepository
{
  // Find Recipes by category.
  public function findByCategory(string $category): array
  {
    $matchRecipes = null;
    if ($category == 'All') {
      $matchRecipes = RecipesModel::where('isDeleted', false)->get();
    } else {
      $matchRecipes = RecipesModel::where('category', 'LIKE', "%{$category}%")->where('isDeleted', false)->get();
    }

    return $matchRecipes->map(function ($recipe) {
      return new Recipes(
        $recipe->id,
        $recipe->name,
        $recipe->description,
        $recipe->category,
        $recipe->ingredients,
        $recipe->country,
        $recipe->prep_time,
        $recipe->yt_link,
        $recipe->image,
        $recipe->isDeleted,
        $recipe->created_at,
        $recipe->updated_at
      );
    })->toArray();
  }


  // Find Recipes by id.
  public function findById(int $id): ?Recipes
  {
    $recipe = RecipesModel::find($id);
    if (!$recipe) {
      return null;
    }
    return new Recipes(
      $recipe->id,
      $recipe->name,
      $recipe->description,
      $recipe->category,
      $recipe->ingredients,
      $recipe->country,
      $recipe->prep_time,
      $recipe->yt_link,
      $recipe->image,
      $recipe->isDeleted,
      $recipe->created_at,
      $recipe->updated_at
    );
  }
  public function searchByTerm(string $searchTerm): array
  {
    $exactMatch = RecipesModel::where('name', $searchTerm)
      ->orWhere('description', $searchTerm)
      ->orWhere('category', $searchTerm)
      ->orWhere('country', $searchTerm)
      ->orWhere('ingredients', $searchTerm)
      ->where('isDeleted', false)
      ->first();

    $relatedMatch = RecipesModel::where('id', '!=', $exactMatch?->id)
      ->where('isDeleted', false)
      ->where(
        function ($query) use ($searchTerm) {
          $query->where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->orWhere('category', 'LIKE', "%{$searchTerm}%")
            ->orWhere('country', 'LIKE', "%{$searchTerm}%")
            ->orWhere('ingredients', 'LIKE', "%{$searchTerm}%");
        }
      )->get();

    return [
      'exact_match' => $exactMatch ? new Recipes(
        $exactMatch->id,
        $exactMatch->name,
        $exactMatch->description,
        $exactMatch->category,
        $exactMatch->ingredients,
        $exactMatch->country,
        $exactMatch->prep_time,
        $exactMatch->yt_link,
        $exactMatch->image,
        $exactMatch->isDeleted,
        $exactMatch->created_at,
        $exactMatch->updated_at
      ) : null,
      'related_match' => $relatedMatch->map(function ($recipes) {
        return new Recipes(
          $recipes->id,
          $recipes->name,
          $recipes->description,
          $recipes->category,
          $recipes->ingredients,
          $recipes->country,
          $recipes->prep_time,
          $recipes->yt_link,
          $recipes->image,
          $recipes->isDeleted,
          $recipes->created_at,
          $recipes->updated_at
        );
      })->toArray()
    ];
  }

  public function getAllCategoryCounts()
  {
    $categories = CategoriesModel::where('isShow', true)->get();
    $categoryCounts = [];

    foreach ($categories as $category) {
      $count = $category->name === 'All'
        ? RecipesModel::where('isDeleted', false)->count()
        : RecipesModel::where('category', 'LIKE', "%{$category->name}%")
          ->where('isDeleted', false)
          ->count();

      $categoryCounts[] = [
        'count' => $count,
        'category' => $category->name,
        'icon' => $category->icon,
      ];
    }

    return $categoryCounts;
  }
  public function getAllCategoryCountsByCountry(string $countryName)
  {
    $categories = CategoriesModel::where('isShow', true)->get();
    $categoryCounts = [];

    foreach ($categories as $category) {
      $count = $category->name === 'All'
        ? RecipesModel::where('country', $countryName)->where('isDeleted', false)->count()
        : RecipesModel::where('country', $countryName)
          ->where('category', 'LIKE', "%{$category->name}%")
          ->where('isDeleted', false)
          ->count();

      $categoryCounts[] = [
        'count' => $count,
        'category' => $category->name,
        'icon' => $category->icon,
      ];
    }

    return $categoryCounts;
  }
  public function getAllRecipeCountry()
  {
    $countries = RecipesModel::select('country')->distinct()->get();

    return [
      'country' => $countries,
    ];
  }
  public function ingredientsSearch(array $ingredients): array
  {
    $recipes = [];
    foreach ($ingredients as $ingredient) {
      $matchingRecipes = RecipesModel::where('ingredients', 'LIKE', "%{$ingredient}%")->get()->toArray();
      foreach ($matchingRecipes as $recipe) {
        if (!in_array($recipe, $recipes)) {
          $recipes[] = $recipe;
        }
      }
    }
    return $recipes;
  }

  //====================================== BLADE BUSINESS LOGIC ======================================
  public function findAll(): array
  {
    $recipes = RecipesModel::where('isDeleted', false)->get();

    return [
      'recipes' => $recipes,
    ];
  }
  public function create(Recipes $recipes): void
  {
    $recipesModel = RecipesModel::find($recipes->getId()) ?? new RecipesModel();

    $recipesModel->id = $recipes->getId();
    $recipesModel->name = $recipes->getName();
    $recipesModel->description = $recipes->getDescription();
    $recipesModel->category = $recipes->getCategory();
    $recipesModel->ingredients = $recipes->getIngredients();
    $recipesModel->country = $recipes->getCountry();
    $recipesModel->prep_time = $recipes->getPrepTime();
    $recipesModel->yt_link = $recipes->getYtLink();
    $recipesModel->image = $recipes->getImage();
    $recipesModel->created_at = $recipes->getCreated();
    $recipesModel->updated_at = $recipes->getUpdated();
    $recipesModel->save();
  }
  public function update(Recipes $recipes): void
  {
    $recipeExist = RecipesModel::find($recipes->getId());

    if ($recipeExist) {
      $recipeExist->name = $recipes->getName();
      $recipeExist->description = $recipes->getDescription();
      $recipeExist->category = $recipes->getCategory();
      $recipeExist->ingredients = $recipes->getIngredients();
      $recipeExist->country = $recipes->getCountry();
      $recipeExist->prep_time = $recipes->getPrepTime();
      $recipeExist->yt_link = $recipes->getYtLink();
      $recipeExist->image = $recipes->getImage();
      $recipeExist->updated_at = $recipes->getUpdated();
      $recipeExist->save();
    } else {
      $recipeModel = new RecipesModel();
      $recipeModel->id = $recipes->getId();
      $recipeModel->name = $recipes->getName();
      $recipeModel->description = $recipes->getDescription();
      $recipeModel->category = $recipes->getCategory();
      $recipeModel->ingredients = $recipes->getIngredients();
      $recipeModel->country = $recipes->getCountry();
      $recipeModel->prep_time = $recipes->getPrepTime();
      $recipeModel->yt_link = $recipes->getYtLink();
      $recipeModel->image = $recipes->getImage();
      $recipeModel->updated_at = $recipes->getUpdated();
      $recipeModel->save();
    }
  }
  public function delete(int $id): void
  {
    $recipeExist = RecipesModel::find($id);
    $recipeExist->isDeleted = true;
    $recipeExist->save();
  }
  public function findDeleted(): array
  {
    $recipes = RecipesModel::where('isDeleted', true)->get();
    return [
      'recipes' => $recipes,
    ];
  }
  public function restore(int $id): void
  {
    $recipeExist = RecipesModel::find($id);
    $recipeExist->isDeleted = false;
    $recipeExist->save();
  }
  public function findAllCategory()
  {
    $categories = CategoriesModel::all();
    return $categories;
  }
  public function updateShowCategory(int $id): void
  {
    $category = CategoriesModel::find($id);
    $category->isShow = !$category->isShow;
    $category->save();
  }
}
