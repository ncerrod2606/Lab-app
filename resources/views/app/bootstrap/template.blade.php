<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Archivo de Héroes - Catálogo digital completo de superhéroes Marvel y DC">
        <meta name="theme-color" content="#0f2e5f">
        <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon.ico') }}"> 
        
        <title>@yield('title', 'Archivo de Héroes')</title>
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Estilos personalizados -->
        <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}"> 
        @yield('styles')
    </head>
    <body>
        <!-- NAVBAR SOFISTICADO -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-lg">
                <!-- BRAND -->
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    <i class="fas fa-shield-alt"></i>
                    <span>Héroes</span>
                </a>
                
                <!-- TOGGLER MOBILE -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- NAVEGACIÓN -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('heroe.index') }}" title="Ver catálogo completo">
                                <i class="fas fa-book"></i> Catálogo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}" title="Más información">
                                <i class="fas fa-info-circle"></i> Acerca de
                            </a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('heroe.create') }}" title="Crear nuevo héroe">
                                <i class="fas fa-star"></i> Nuevo
                            </a>
                        </li>
                        @endauth
                    </ul>

                    <!-- BUSCADOR -->
                    <form class="d-flex ms-lg-3 my-2 my-lg-0" role="search" id="searchForm">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-sm" type="search" 
                                placeholder="Buscar héroe..." 
                                aria-label="Search" id="searchInput"
                                autocomplete="off">
                            <button class="btn btn-sm btn-outline-light" type="submit" title="Buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- AUTENTICACIÓN -->
                    <div class="ms-3">
                        @guest
                            <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}" title="Acceder a tu cuenta">
                                <i class="fas fa-sign-in-alt"></i> <span class="d-none d-sm-inline">Acceder</span>
                            </a>
                        @else
                            <div class="btn-group" role="group">
                                <button id="userBtn" type="button" class="btn btn-sm btn-outline-light dropdown-toggle" 
                                    data-bs-toggle="dropdown" aria-expanded="false" title="Menú de usuario">
                                    <i class="fas fa-user-circle"></i> 
                                    <span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Usuario' }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userBtn">
                                    <li><a class="dropdown-item" href="#" title="Ver perfil">
                                        <i class="fas fa-user"></i> Mi Perfil
                                    </a></li>
                                    <li><a class="dropdown-item" href="#" title="Configuración">
                                        <i class="fas fa-cog"></i> Configuración
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#" id="logout-link" title="Cerrar sesión">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </a></li>
                                </ul>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- ALERTAS -->
        <div class="container-lg mt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle flex-shrink-0 mt-1"></i>
                        <div>
                            <strong>¡Éxito!</strong> {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif
            
            @if(session('mensajeTexto'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-start gap-2">
                        <i class="fas fa-check-circle flex-shrink-0 mt-1"></i>
                        <div>
                            <strong>¡Éxito!</strong> {{ session('mensajeTexto') }}
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-start gap-2">
                        <i class="fas fa-exclamation-circle flex-shrink-0 mt-1"></i>
                        <div>
                            <strong>Error:</strong> Por favor, corrige los siguientes errores:
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                </div>
            @endif
        </div>

        <!-- CONTENIDO PRINCIPAL -->
        <main role="main">
            @yield('content')
        </main>

        <!-- FOOTER PREMIUM -->
        <footer class="bg-dark text-light py-5 mt-5">
            <div class="container-lg">
                <div class="row g-5">
                    <div class="col-md-4">
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                                <i class="fas fa-shield-alt text-warning"></i>
                                Archivo de Héroes
                            </h5>
                            <p class="small text-light opacity-75">
                                Catálogo digital innovador de superhéroes. Explora, valora y comparte tus opiniones 
                                sobre los héroes de Marvel y DC.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase text-warning" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                            <i class="fas fa-link"></i> Navegación
                        </h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <a href="{{ route('heroe.index') }}" class="text-light text-decoration-none opacity-75 transition-all" 
                                   style="transition: all 0.3s ease;">
                                    <i class="fas fa-chevron-right"></i> Catálogo Completo
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('about') }}" class="text-light text-decoration-none opacity-75 transition-all" 
                                   style="transition: all 0.3s ease;">
                                    <i class="fas fa-chevron-right"></i> Acerca de
                                </a>
                            </li>
                            @auth
                            <li class="mb-2">
                                <a href="{{ route('heroe.create') }}" class="text-light text-decoration-none opacity-75 transition-all" 
                                   style="transition: all 0.3s ease;">
                                    <i class="fas fa-chevron-right"></i> Crear Héroe
                                </a>
                            </li>
                            @else
                            <li class="mb-2">
                                <a href="{{ route('login') }}" class="text-light text-decoration-none opacity-75 transition-all" 
                                   style="transition: all 0.3s ease;">
                                    <i class="fas fa-chevron-right"></i> Acceder
                                </a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                    
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3 text-uppercase text-warning" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                            <i class="fas fa-code"></i> Tecnología
                        </h6>
                        <p class="small text-light opacity-75 mb-3">
                            Desarrollado con las tecnologías más modernas:
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary">Laravel 11</span>
                            <span class="badge bg-info">Bootstrap 5</span>
                            <span class="badge" style="background: linear-gradient(135deg, #FF8C00, #FFA500);">MySQL</span>
                        </div>
                    </div>
                </div>

                <!-- DIVISOR -->
                <hr class="bg-secondary opacity-25 my-4">

                <!-- COPYRIGHT -->
                <div class="row">
                    <div class="col-12">
                        <p class="text-center small text-light opacity-75 mb-0">
                            &copy; 2024 <strong>Archivo de Héroes</strong>. Todos los derechos reservados. 
                            Diseñado con <i class="fas fa-heart text-danger"></i> por desarrolladores apasionados.
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
        
        <!-- Scripts principales -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Logout handler
                const logoutLink = document.getElementById('logout-link');
                if (logoutLink) {
                    logoutLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        document.getElementById('logout-form').submit();
                    });
                }

                // Accessibility: Enhanced keyboard navigation
                const navLinks = document.querySelectorAll('.nav-link');
                navLinks.forEach(link => {
                    link.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            window.location.href = this.href;
                        }
                    });
                });

                // Smooth scroll behavior
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            e.preventDefault();
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            });
        </script>
        
        <script src="{{ url('assets/js/main.js') }}"></script> 
        @yield('scripts')
    </body>
</html>