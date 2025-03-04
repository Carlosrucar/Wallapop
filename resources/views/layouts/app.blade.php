<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\Setting::first()->name ?? 'Wallapop Clone' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #13C1AC;
            --secondary-color: #90A4AE;
        }

        .navbar-custom {
            background-color: var(--primary-color) !important;
        }

        .nav-link {
            font-weight: bold;
            padding: 0.75rem 1rem;
            color: white !important;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link:hover {
            background-color: var(--secondary-color);
            color: white;
            border-radius: 5px;
        }

        /* Existing styles below */
        .btn-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-custom:hover {
            background-color: #0FA192;
            border-color: #0FA192;
            color: white;
        }

        .card {
            transition: transform 0.2s;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .price-tag {
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: bold;
        }

        .search-bar {
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
        }

        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-store me-2"></i>{{ \App\Models\Setting::first()->name ?? 'Wallapop' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form action="{{ route('products.index') }}" method="GET" class="d-flex mx-auto" style="width: 50%;">
                    <input class="form-control search-bar me-2" type="search" name="search"
                        placeholder="¿Qué estás buscando?">
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sales.create') }}">
                            <i class="fas fa-plus-circle me-1"></i>Vender
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('account.index') }}">
                            <i class="fas fa-user me-1"></i>Mi Cuenta
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link border-0 bg-transparent">
                                    <i class="fas fa-sign-out-alt me-1"></i>Cerrar sesión
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main container with flex-grow to push footer to the bottom -->
    <main class="container flex-grow-1 py-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-light py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Sobre Nosotros</h5>
                    <p>Tu marketplace de confianza para comprar y vender.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces Útiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Ayuda</a></li>
                        <li><a href="#" class="text-light">Términos y Condiciones</a></li>
                        <li><a href="#" class="text-light">Privacidad</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <div class="social-icons">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>