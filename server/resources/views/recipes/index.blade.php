<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Food Hub | Admin | Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .table td,
        .table th {
            font-size: 13px;
        }

        .btn-success,
        .btn-danger {
            font-size: 13px;
        }

        .content-side {
            height: 100vh;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 p-0">
                @include('navbar')
            </div>
            <div class="col-11 content-side">
                <div class="row justify-content-center">
                    <div class="mx-4 mt-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2>Recipes</h2>
                            <a href="/recipes/create" class="btn btn-success me-3" style="font-size: 14px;">Add Recipe</a>
                        </div>
                        <div class="table-responsive px-3">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Ingredients</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">YouTube Link</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recipes['recipes'] as $recipe)
                                        <tr>
                                            <td>{{ $recipe->id }}</td>
                                            <td>{{ $recipe->name }}</td>
                                            <td>{{ $recipe->description }}</td>
                                            <td>{{ $recipe->category }}</td>
                                            <td>
                                                @php
                                                    $ingredients =
                                                        json_decode($recipe->ingredients, true) ??
                                                        explode(',', $recipe->ingredients);
                                                @endphp
                                                <ul class="list-unstyled m-0">
                                                    @foreach ($ingredients as $ingredient)
                                                        <li>{{ trim($ingredient) }},</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $recipe->country }}</td>
                                            <td>{{ $recipe->yt_link }}</td>
                                            <td class="p-1">
                                                <img src="{{ asset('images/' . $recipe->image) }}" alt="Recipe" class="img-thumbnail"
                                                    style="max-width: 100px;">
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="#" class="btn btn-sm me-1 btn-success">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
