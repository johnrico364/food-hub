<?php

namespace App\Domain\Recipes;

interface RecipesRepository
{
  public function findByCategory(string $category): array;
  public function findById(int $id): ?Recipes;
  public function searchByTerm(string $searchTerm): array;
  public function getAllCategoryCounts();
  public function getAllCategoryCountsByCountry(string $countryName);
  public function getAllRecipeCountry();

  //blade business logic
  public function findAll() : array;
  public function create(Recipes $recipes): void;
  public function update(Recipes $recipes): void;
  public function delete(int $id): void;
  public function findDeleted(): array;
  public function restore(int $id): void;
  public function findAllCategory();
  public function updateShowCategory(int $id): void;
}