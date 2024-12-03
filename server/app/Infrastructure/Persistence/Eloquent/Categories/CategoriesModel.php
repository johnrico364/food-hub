<?php

namespace App\Infrastructure\Persistence\Eloquent\Categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesModel extends Model
{
  use HasFactory;
  protected $table = 'categories';
  protected $fillable = [
    'name',
    'icon',
    'isShow',
  ];
}

