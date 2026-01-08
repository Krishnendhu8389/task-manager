<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 col-md-4 mx-auto">
<h4>Login</h4>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="/login">
@csrf

<input class="form-control mb-2" name="email" placeholder="Email">
<input type="password" class="form-control mb-2" name="password" placeholder="Password">

<button class="btn btn-primary w-100">Login</button>
<a href="/register" class="d-block mt-2">Create account</a>

</form>
</div>
</div>

</body>
</html>
