<?php

namespace App\Infrastructure\Persistence\Eloquent\Recipes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipesModel extends Model
{
  use HasFactory;
  protected $table = 'recipes';
  protected $fillable = [
    'id',
    'name',
    'description',
    'category',
    'ingredients',
    'country',
    'prep_time',
    'yt_link',
    'image',
    'created_at',
    'updated_at'
  ];
}
