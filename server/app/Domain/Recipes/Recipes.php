<?php

namespace App\Domain\Recipes;

class Recipes
{
  private ?int $id;
  private ?string $name;
  private ?string $description;
  private ?string $category;
  private ?string $ingredients;
  private ?string $country;
  private ?int $prep_time;
  private ?string $yt_link;
  private ?array $image;
  private ?bool $isDeleted;
  private ?string $created_at;
  private ?string $updated_at;

  public function __construct(
    ?int $id = null,
    ?string $name = null,
    ?string $description = null,
    ?string $category = null,
    ?string $ingredients = null,
    ?string $country = null,
    ?int $prep_time = null,
    ?string $yt_link = null,
    ?array $image = null,
    ?bool $isDeleted = false,
    ?string $created_at = null,
    ?string $updated_at = null,
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->category = $category;
    $this->ingredients = $ingredients;
    $this->country = $country;
    $this->prep_time = $prep_time;
    $this->yt_link = $yt_link;
    $this->image = $image;
    $this->isDeleted = $isDeleted;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
  }

  public function toArray(): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'description' => $this->description,
      'category' => $this->category,
      'ingredients' => $this->ingredients,
      'country' => $this->country,
      'prep_time' => $this->prep_time,
      'yt_link' => $this->yt_link,
      'image' => $this->image,
      'isDeleted' => $this->isDeleted,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }

  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getCategory()
  {
    return $this->category;
  }
  public function getIngredients()
  {
    return $this->ingredients;
  }
  public function getCountry()
  {
    return $this->country;
  }
  public function getPrepTime()
  {
    return $this->prep_time;
  }
  public function getYtLink()
  {
    return $this->yt_link;
  }
  public function getImage()
  {
    return $this->image;
  }
  public function getIsDeleted()
  {
    return $this->isDeleted;
  }
  public function getCreated()
  {
    return $this->created_at;
  }
  public function getUpdated()
  {
    return $this->updated_at;
  }
}