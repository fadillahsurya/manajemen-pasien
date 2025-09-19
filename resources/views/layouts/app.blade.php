<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pasien</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f0f4f8;
            color: #1e293b;
            font-family: 'Roboto', sans-serif;
        }
        main {
            flex: 1;
        }

        .navbar {
            background: linear-gradient(90deg, #1976d2, #2e7d32) !important; /* biru → hijau */
        }
        .navbar .nav-link, 
        .navbar .navbar-brand { 
            color: #fff !important; 
        }
        .navbar .btn-link.nav-link { 
            color: #fff !important; 
            text-decoration: none; 
        }

        .card { 
            background-color: #ffffff; 
            border-radius: 0.5rem; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
        }
        .table thead { 
            background: linear-gradient(90deg, #1976d2, #2e7d32); 
            color: #fff; 
        }

        .btn-primary { background-color: #1976d2; border-color: #1976d2; }
        .btn-primary:hover { background-color: #115293; border-color: #115293; }
        .btn-secondary { background-color: #4caf50; border-color: #4caf50; }
        .btn-secondary:hover { background-color: #357a38; border-color: #357a38; }

        footer { 
            background: linear-gradient(90deg, #2e7d32, #1976d2); 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('patients.index') }}">
                🏥 PKU WONOSOBO
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if(auth()->check())
                        <li class="nav-item">
                            <span class="nav-link text-warning">
                                Login sebagai: {{ auth()->user()->email }}
                            </span>
                        </li>
                    @else
                        <li class="nav-item">
                            <span class="nav-link text-danger">
                                Belum login
                            </span>
                        </li>
                    @endif

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.Auth::user()->name }}"
                                     alt="Avatar" class="rounded-circle me-2" width="35" height="35">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ route('login.form') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register.form') }}" class="nav-link">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="text-white text-center py-3">
        <small>© {{ date('Y') }} PKU WONOSOBO - All rights reserved</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
