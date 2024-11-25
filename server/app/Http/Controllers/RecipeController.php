<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Recipes\RegisterRecipes;

class RecipeController extends Controller
{
    private RegisterRecipes $registerRecipes;

    public function __construct(RegisterRecipes $registerRecipes)
    {
        $this->registerRecipes = $registerRecipes;
    }
    public function index()
    {
        $recipes = $this->registerRecipes->findAllRecipes();
        return view('recipes.index', compact('recipes'));
    }
    public function create()
    {
        return view('recipes.create');
    }

    public function update($id)
    {
        return view('recipes.update', compact('id'));
    }
}
