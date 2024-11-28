<?php

namespace App\Application\Recipes;

use App\Domain\Recipes\RecipesRepository;
use App\Domain\Recipes\Recipes;

class RegisterRecipes
{
  private RecipesRepository $recipesRepository;
  public function __construct(RecipesRepository $recipesRepository)
  {
    $this->recipesRepository = $recipesRepository;
  }
  public function findByCategory(string $category)
  {
    return $this->recipesRepository->findByCategory($category);
  }
  public function findById(int $id)
  {
    return $this->recipesRepository->findById($id);
  }
  public function searchRecipes(string $searchTerm)
  {
    $result = $this->recipesRepository->searchByTerm($searchTerm);

    return [
      'exact_match' => $result['exact_match'] ? $result['exact_match']->toArray() : null,
      'related_match' => array_map(function ($recipe) {
        return $recipe->toArray();
      }, $result['related_match'])
    ];
  }
  public function findAllCategoryCount()
  {
    return $this->recipesRepository->getAllCategoryCounts();
  }
  public function findAllCategoryCountByCountry(string $country_name)
  {
    return $this->recipesRepository->getAllCategoryCountsByCountry($country_name);
  }
  public function findAllCountries()
  {
    return $this->recipesRepository->getAllRecipeCountry();
  }

  //blade business logic
  public function findAllRecipes()
  {
    return $this->recipesRepository->findAll();
  }
  public function create(
    string $name,
    string $description,
    string $category,
    string $ingredients,
    string $country,
    int $prep_time,
    string $yt_link,
    string $image,
    string $created_at,
    string $updated_at
  ) {
    $data = new Recipes(
      null,
      $name,
      $description,
      $category,
      $ingredients,
      $country,
      $prep_time,
      $yt_link,
      $image,
      $created_at,
      $updated_at
    );
    $this->recipesRepository->create($data);
  }
  public function update(
    int $id,
    string $name,
    string $description,
    string $category,
    string $ingredients,
    string $country,
    int $prep_time,
    string $yt_link,
    string $image,
    string $updated_at
  ) {
    $updateRecipes = new Recipes(
      $id,
      $name,
      $description,
      $category,
      $ingredients,
      $country,
      $prep_time,
      $yt_link,
      $image,
      null,
      $updated_at
    );
    $this->recipesRepository->update($updateRecipes);
  }
}