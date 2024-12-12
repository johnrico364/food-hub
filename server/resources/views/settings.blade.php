<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Food Hub | Admin | Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 p-0">
                @include('navbar')
            </div>
            <div class="col-11 px-5 pt-5 content-side border">
                <h4>Shown Categories</h4>
                <div class="d-flex mb-4 mt-2">
                    @foreach ($categories as $category)
                        <form action="/category/update/{{ $category->id }}" method="POST">
                            @csrf
                            <button
                                class="rounded-pill me-2 btn {{ $category->isShow ? 'btn-success' : 'btn-secondary' }}"
                                style="cursor: pointer;">
                                {{ $category->name }}
                            </button>
                        </form>
                    @endforeach
                </div>
                <h4>Admin Details</h4>

                <div class="mb-3 p-4 bg-light rounded shadow-sm" id="adminDetails">
                    <p class="fs-4 mb-3"><strong>Name:</strong> <span class="text-secondary">{{Auth::user()->name}}</span></p>
                    <p class="fs-4"><strong>Email:</strong> <span class="text-secondary">{{Auth::user()->email}}</span></p>
                </div>

                <button type="button" class="btn btn-success mb-3" id="showFormBtn">Edit Profile</button>

                <form method="POST" action="{{ route('update.admin') }}" class="col-md-6" id="profileForm" style="display: none;">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i> Show
                            </button>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="mb-3 btn btn-success">Update Profile</button>
                        <button type="button" class="mb-3 btn btn-secondary" id="cancelBtn">Cancel</button>
                    </div>
                </form>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success mb-3">Logout</button>
                </form>

            </div>
        </div>
    </div>
</body>

<script>
    document.getElementById('showFormBtn').addEventListener('click', function() {
        document.getElementById('profileForm').style.display = 'block';
        document.getElementById('adminDetails').style.display = 'none';
        this.style.display = 'none';
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('profileForm').style.display = 'none';
        document.getElementById('adminDetails').style.display = 'block';
        document.getElementById('showFormBtn').style.display = 'block';
    });

    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Show' : 'Hide';
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
