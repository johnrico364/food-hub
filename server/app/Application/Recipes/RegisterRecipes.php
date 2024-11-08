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
  public function create(int $id, string $name, string $category)
  {
    $data = new Recipes($id, $name, $category);
    $this->recipesRepository->create($data);
  }
  public function update()
  {
  }
  public function findByCategory(string $category)
  {
    return $this->recipesRepository->findByCategory($category);
  }
  public function findByCountry(string $country)
  {
    return $this->recipesRepository->findByCountry($country);
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
  public function findAllCountries()
  {
    return $this->recipesRepository->getAllRecipeCountry();
  }
}