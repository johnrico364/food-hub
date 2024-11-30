<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recipe | Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .tip-text {
        font-size: 11px;
        color: #888;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 p-0">
                @include('navbar')
            </div>
            <div class="col-11 content-side">
                <div class="row mt-5 justify-content-center">
                    <div class="col-9 p-4">
                        <h2 class="mb-4">Update Recipe</h2>
                        <form action="{{ route('recipes.update.store', $recipe['id']) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Recipe Name</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                    value="{{ $recipe['name'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $recipe['description'] }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <span class="tip-text">
                                    <b>Tips: Provide space on each category and capitalize each category</b>
                                    | Ex: Main Course, Breakfast, Soups, Pasta, Desserts, Salad, Baked, Snacks,
                                    Appetizers, Seafood
                                </span>
                                <input type="text" class="form-control" id="category" name="category" required
                                    value="{{ $recipe['category'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="ingredients" class="form-label">Ingredients</label>
                                <span class="tip-text">
                                    <b>Tips: Provide space on each ingredient and capitalize each ingredient</b>
                                    | Ex: Soy sauce, Pepper, Salt,Onion</span>
                                <textarea class="form-control" id="ingredients" name="ingredients" rows="4" required>{{ $recipe['ingredients'] }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" required
                                    value={{$recipe['country']}}>
                            </div>
                            <div class="mb-3">
                                <label for="prep_time" class="form-label">Preparation Time (minutes)</label>
                                <input type="number" class="form-control" id="prep_time" name="prep_time" required value={{$recipe['prep_time']}}>
                            </div>
                            <div class="mb-3">
                                <label for="yt_link" class="form-label">YouTube Link</label>
                                <input type="text" class="form-control" id="yt_link" name="yt_link" required value={{$recipe['yt_link']}}>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Recipe Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <img src="{{ asset('images/' . $recipe['image']) }}" alt="Image" class="mt-2" style="max-width: 200px;">
                            </div>
                            <button type="submit" class="btn btn-success">Update Recipe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
