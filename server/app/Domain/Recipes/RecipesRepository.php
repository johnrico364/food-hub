<?php

namespace App\Domain\Recipes;

interface RecipesRepository
{
  public function create(Recipes $recipes): void;
  public function update(Recipes $recipes): void;
  public function findByCategory(string $category): array;
  public function findById(int $id): ?Recipes;
  public function searchByTerm(string $searchTerm): array;
  public function getAllCategoryCounts();
  public function getAllRecipeCountry();
}