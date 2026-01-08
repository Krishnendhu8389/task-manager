<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 col-md-4 mx-auto">
<h4>Register</h4>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form method="POST" action="/register" novalidate>

@csrf

<input class="form-control mb-2" name="name" placeholder="Name">
<input class="form-control mb-2" name="email" placeholder="Email">
<input type="password" class="form-control mb-2" name="password" placeholder="Password">
<input type="password" class="form-control mb-2" name="password_confirmation" placeholder="Confirm Password">

<button class="btn btn-success w-100">Register</button>
<a href="/login" class="d-block mt-2">Already have account?</a>

</form>
</div>
</div>

</body>
</html>

