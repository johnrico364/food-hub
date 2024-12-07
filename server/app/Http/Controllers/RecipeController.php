<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Recipes\RegisterRecipes;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Infrastructure\Persistence\Eloquent\Recipes\RecipesModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecipeController extends Controller
{
    private RegisterRecipes $registerRecipes;

    public function __construct(RegisterRecipes $registerRecipes)
    {
        $this->registerRecipes = $registerRecipes;
    }
    public function login()
    {
        return view('login');
    }
    public function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->only('email', 'password');

        if (Auth::attempt($credential)) {
            return redirect('recipes')->with('message', 'Login Complete...');
        }

        return redirect('/')->with('message', 'Login Failed...');
    }
    public function logout()
    {
        // dd("ok");

        Session::flush();
        Auth::logout();
        return redirect('/');
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

    public function update($id)
    {
        $recipe = RecipesModel::find($id);
        if (!$recipe) {
            return redirect()->back()->with('error', 'Recipe not found');
        }

        $recipe['category'] = implode(', ', json_decode($recipe['category'], true));
        $recipe['ingredients'] = implode(', ', json_decode($recipe['ingredients'], true));

        return view('recipes.update', compact('recipe'));
    }
    public function updateStore(Request $request, $id)
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

        $recipe = RecipesModel::find($id);
        if ($request->hasFile('image')) {
            if ($recipe->image !== 'default.jpg') {
                File::delete('images/' . $recipe->image);
            }

            $image = $request->file('image');
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move('images', $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = $recipe->image;
        }

        $arrayCategory = explode(', ', $request->category);
        $arrayIngredients = explode(', ', $request->ingredients);

        $this->registerRecipes->update(
            $id,
            $request->name,
            $request->description,
            json_encode($arrayCategory),
            json_encode($arrayIngredients),
            $request->country,
            $request->prep_time,
            $request->yt_link,
            $data['image'],
            Carbon::now()->toDateTimeString(),
        );

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully');

    }
    public function destroy($id)
    {
        $this->registerRecipes->deleteRecipe($id);
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully');
    }

    public function settings()
    {
        $categories = $this->registerRecipes->findAllCategory();
        return view('settings', compact('categories'));
    }
    public function updateShowCategory($id)
    {
        $this->registerRecipes->updateShowCategory($id);
        return redirect()->route('settings')->with('success', 'Category updated successfully');
    }
    public function archive()
    {
        $deletedRecipes = $this->registerRecipes->findDeletedRecipes();
        return view('recipes.archive', compact('deletedRecipes'));
    }
    public function restore($id)
    {
        $this->registerRecipes->restoreRecipe($id);
        return redirect()->route('archive')->with('success', 'Recipe restored successfully');
    }
}
