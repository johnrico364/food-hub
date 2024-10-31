<?php

namespace App\Infrastructure\Persistence\Eloquent\Recipes;

use App\Domain\Recipes\RecipesRepository;
use App\Domain\Recipes\Recipes;

class EloquentRecipesRepository implements RecipesRepository
{
  // Add Recipes
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
  }
  public function update(Recipes $recipes): void
  {
  }

  // Find Recipes by category.
  public function findByCategory(string $category): array
  {
    $matchRecipes = null;
    if ($category == 'all') {
      $matchRecipes = RecipesModel::all();
    } else {
      $matchRecipes = RecipesModel::where('category', 'LIKE', "%{$category}%");
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
      ->orWhere('ingredients', $searchTerm);

    $relatedMatch = RecipesModel::where('id', '!=', $exactMatch?->id)->where(
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
          $recipes->created_at,
          $recipes->updated_at
        );
      })->toArray()
    ];
  }
}