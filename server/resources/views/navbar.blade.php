<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .navbar-button {
        font-size: 14px;
    }
    .content-side {
        height: 100vh;
        overflow-y: auto;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="text-center">
            <img src="{{ asset('/logo.png') }}" alt="Food Hub Logo" class="img-fluid mt-5"
                style="width: 180px; height: 30px;">
        </div>
        <div class="row mt-5">
            <div class="d-flex flex-column">
                <a href="{{ route('recipes.index') }}" class="btn btn-success mb-3 navbar-button">Recipes</a>
            </div>
            <div class="d-flex flex-column">
                <a href="{{ route('recipes.index') }}" class="btn btn-success mb-3 navbar-button">Settings</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
