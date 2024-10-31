<?php

namespace App\Http\Controllers\Recipes;

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
}


