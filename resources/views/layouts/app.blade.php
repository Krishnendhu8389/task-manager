<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar Customizations */
        .navbar {
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
            color: #2575fc;
        }

        .navbar-brand:hover {
            color: #6a11cb;
        }

        .nav-link {
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link:focus {
            color: #2575fc !important;
        }

        .btn-link.nav-link {
            color: #dc3545;
            text-decoration: none;
        }

        .btn-link.nav-link:hover {
            text-decoration: underline;
            color: #bd2130;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1 0 auto;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tasks.index') }}">Task Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @auth
                        <li class="nav-item me-3">
                            <span class="nav-link text-dark">Hello, <strong>{{ auth()->user()->name }}</strong></span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm rounded-pill" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm rounded-pill">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/register') }}" class="btn btn-primary btn-sm rounded-pill">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mb-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} Task Manager. All rights reserved.</p>
            <div>
                <a href="#">About</a> | 
                <a href="#">Contact</a> | 
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


