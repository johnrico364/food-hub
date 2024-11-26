<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Recipes\RegisterRecipes;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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

    public function store(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'ingredients' => 'required|string',
            'country' => 'required|string',
            'prep_time' => 'required|integer',
            'yt_link' => 'required|string',
            'image' => 'nullable',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move('images', $imageName);

            $data['image'] = $imageName;
        } else {
            $data['image'] = 'default.jpg';
        }

        $arrayCategory = explode(', ', $request->category);
        $arrayIngredients = explode(', ', $request->ingredients);

        $this->registerRecipes->create(
            $request->name,
            $request->description,
            json_encode($arrayCategory),
            json_encode($arrayIngredients),
            $request->country,
            $request->prep_time,
            $request->yt_link,
            $data['image'],
            Carbon::now()->toDateTimeString(),
            Carbon::now()->toDateTimeString(),
        );

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully');
    }
}
