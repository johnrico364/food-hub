<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Recipes\RegisterRecipes;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Infrastructure\Persistence\Eloquent\Recipes\RecipesModel;
use App\Infrastructure\Persistence\Eloquent\Categories\CategoriesModel;
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
        $categories = CategoriesModel::all()
            ->where('isShow', '=', 1)
            ->where('name', '!=', 'All')
            ->select('name', 'id');
        return view('recipes.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'description' => 'required|string',
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
            $images = $request->file('image');
            $imageNames = [];
            
            foreach($images as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('images', $imageName);
                $imageNames[] = $imageName;
            }

            $data['image'] = json_encode($imageNames);
        } else {
            $data['image'] = json_encode(['default.jpg']);
        }

        // make category from request to array
        $arrayCategory = [];
        for ($i = 1; $i <= 11; $i++) {
            if ($request->has('category-' . $i)) {
                $arrayCategory[] = $request->input('category-' . $i);
            }
        }

        $arrayIngredients = [];
        $arrayIngredients = explode(', ', $data['ingredients']);

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
        $categories = CategoriesModel::all()
            ->where('isShow', '=', 1)
            ->where('name', '!=', 'All')
            ->select('name', 'id');

        $recipe = RecipesModel::find($id);
        $recipe['image'] = json_decode($recipe['image'], true);

        if (!$recipe) {
            return redirect()->back()->with('error', 'Recipe not found');
        }
        
        $recipe['category'] =  json_decode($recipe['category'], true);
        $recipe['ingredients'] = implode(', ', json_decode($recipe['ingredients'], true));

        return view('recipes.update', compact('recipe', 'categories'));
    }
    public function updateStore(Request $request, $id)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'description' => 'required|string',
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
            // Get existing images
            $existingImages = json_decode($recipe->image, true);
            
            // Delete all existing images except default
            if (is_array($existingImages)) {
                foreach ($existingImages as $existingImage) {
                    if ($existingImage !== 'default.jpg') {
                        File::delete('images/' . $existingImage);
                    }
                }
            } else if ($recipe->image !== 'default.jpg') {
                File::delete('images/' . $recipe->image);
            }

            // Handle new image upload
            $image = $request->file('image');
            
            $imageNames = [];
            foreach($image as $img) {
                $imageName = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move('images', $imageName);
                $imageNames[] = $imageName;
            }
            $data['image'] = json_encode($imageNames);
        } else {
            $data['image'] = $recipe->image;
        }

        // make category from request to array
        $arrayCategory = [];
        for ($i = 1; $i <= 11; $i++) {
            if ($request->has('category-' . $i)) {
                $arrayCategory[] = $request->input('category-' . $i);
            }
        }

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
    public function deleteRecipe($id)
    {
        $this->registerRecipes->deleteRecipePermanently($id);
        return redirect()->route('archive')->with('success', 'Recipe deleted successfully');
    }
    public function updateAdmin(Request $request)
    {
        $user = Auth::user();

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('settings')->with('success', 'Profile updated successfully');
    }
}
