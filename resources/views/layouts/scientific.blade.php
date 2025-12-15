<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Investigación Científica</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CDN (Required for Grid System in Views) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #0066cc;
            --primary-light: #3385ff;
            --primary-dark: #0052a3;
            --accent-color: #00d4ff;
            --accent-light: #33e0ff;
            --secondary-color: #1e3a5f;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --background-color: #f0f4f9;
            --surface-color: #ffffff;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--background-color) 0%, #e8f0f8 100%);
            color: var(--text-primary);
            margin: 0;
            display: flex;
            min-height: 100vh;
            letter-spacing: 0.3px;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--background-color);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: #0f172a; /* Dark Navy */
            color: #94a3b8;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100%;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 30px 25px;
            font-size: 1.4rem;
            font-weight: 800;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            gap: 12px;
            background: transparent;
            letter-spacing: 0.5px;
        }

        .sidebar-header span {
            color: #0ea5e9; /* Sky Blue / Cyan */
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar-header i {
            color: #0ea5e9;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-menu li {
            position: relative;
            margin-bottom: 4px;
        }

        .sidebar-menu li a {
            display: block;
            padding: 12px 25px;
            color: #94a3b8; /* Slate 400 */
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .sidebar-menu li a:hover {
            color: #38bdf8; /* Sky 400 */
            background: rgba(56, 189, 248, 0.05);
        }

        .sidebar-menu li a.active {
            background: linear-gradient(90deg, rgba(14, 165, 233, 0.1) 0%, rgba(14, 165, 233, 0) 100%);
            color: #38bdf8;
            border-left-color: #0ea5e9;
        }

        .sidebar > div:last-child {
            padding: 24px;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: #1e293b; /* Slightly lighter for footer area */
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            margin-left: 280px;
            padding: 40px 30px;
            overflow-y: auto;
        }

        .top-bar {
            background: var(--surface-color);
            padding: 25px 35px;
            box-shadow: var(--shadow-md);
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
        }

        .page-title {
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .top-bar > div {
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Alert Messages */
        [style*="background: #e8f5e9"] {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(16, 185, 129, 0.02) 100%) !important;
            color: #047857 !important;
            border: 1px solid rgba(16, 185, 129, 0.2) !important;
            padding: 16px 20px !important;
            border-radius: 10px !important;
            margin-bottom: 25px !important;
            font-weight: 500 !important;
            box-shadow: var(--shadow-sm) !important;
        }

        /* Cards */
        .card {
            background: var(--surface-color);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
            border-color: var(--primary-color);
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-primary);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 30px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0; /* Start hidden */
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        
        /* Glass Card Extension */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        }
        
        .glass-card:hover {
             box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.2);
             transform: translateY(-3px);
        }

        /* Buttons */
        .btn {
            padding: 11px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            display: inline-block;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #2d5a8a 100%);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 58, 95, 0.3);
             color: white;
            text-decoration: none;
        }

        .btn-secondary:active {
            transform: translateY(0);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-danger:active {
            transform: translateY(0);
        }

        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
        }

        .table th, .table td {
            text-align: left;
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table th {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            background: linear-gradient(180deg, #f9fafb 0%, #f3f4f6 100%);
            letter-spacing: 0.5px;
            border-top: none;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 102, 204, 0.03);
        }

        /* Forms */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            color: var(--text-primary);
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.3s ease;
            background-color: #fafbfc;
            color: var(--text-primary);
            height: auto;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.1);
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .tag {
            display: inline-block;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.1) 0%, rgba(0, 102, 204, 0.1) 100%);
            color: var(--primary-dark);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-right: 8px;
            font-weight: 700;
            border: 1px solid rgba(0, 102, 204, 0.2);
            transition: all 0.2s ease;
        }

        .tag:hover {
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(0, 102, 204, 0.2) 100%);
            border-color: var(--primary-color);
        }
        
        /* Dashboard Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: var(--surface-color);
            padding: 28px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            display: flex;
            flex-direction: column;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(0, 212, 255, 0.1), rgba(0, 102, 204, 0.05));
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-color);
        }
        
        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 1;
            letter-spacing: -1px;
        }
        
        .stat-label {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-top: 12px;
            font-weight: 600;
            position: relative;
            z-index: 1;
            letter-spacing: 0.3px;
        }
        
        /* Override Bootstrap Container checks */
        .container, .container-fluid {
             padding-left: 0;
             padding-right: 0;
        }

        /* Utilities */
        .text-right { 
            text-align: right; 
        }

        .mt-2 { 
            margin-top: 10px; 
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 280px;
                z-index: 1050;
            }

            .sidebar.active {
                transform: translateX(0);
            }
            
            /* Overlay for sidebar */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 1040;
            }
            
            .sidebar-overlay.active {
                display: block;
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .top-bar {
                padding: 15px 20px;
                flex-direction: row; /* Keep row for burger + title */
                align-items: center;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <span>🔬 Research Lab</span>
            <button class="btn btn-link text-white d-md-none ml-auto" id="closeSidebar"><i class="fas fa-times"></i></button>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('investigadores.index') }}" class="{{ request()->routeIs('investigadores.*') ? 'active' : '' }}">Investigadores</a></li>
            <li><a href="{{ route('proyectos.index') }}" class="{{ request()->routeIs('proyectos.*') ? 'active' : '' }}">Proyectos</a></li>
            <li><a href="{{ route('experimentos.index') }}" class="{{ request()->routeIs('experimentos.*') ? 'active' : '' }}">Experimentos</a></li>
            <li><a href="{{ route('equipos.index') }}" class="{{ request()->routeIs('equipos.*') ? 'active' : '' }}">Equipos</a></li>
            <li><a href="{{ route('notas.index') }}" class="{{ request()->routeIs('notas.*') ? 'active' : '' }}">Notas de Lab</a></li>
        </ul>
        <div>
             @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary shadow-lg font-weight-bold py-3" style="width: 100%; cursor: pointer; background: #1d4ed8; border: none;">Cerrar Sesión</button>
                </form>
             @else
                <a href="{{ route('login') }}" class="btn btn-primary" style="display: block; text-align: center; width: 100%;">Iniciar Sesión</a>
             @endauth
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-link text-dark d-md-none mr-3 p-0" id="openSidebar"><i class="fas fa-bars fa-lg"></i></button>
                <h1 class="page-title">@yield('title')</h1>
            </div>
            <div class="d-none d-md-block">
                @auth
                    <a href="{{ route('profile.edit') }}" class="text-secondary text-decoration-none transition-hover p-2 rounded hover-bg-light" title="Configurar Perfil">
                        <span class="mr-2">Hola, <strong>{{ Auth::user()->name }}</strong></span>
                        <div class="d-inline-block rounded-circle bg-primary text-white text-center shadow-sm" style="width: 32px; height: 32px; line-height: 32px;">
                            <i class="fas fa-cog"></i>
                        </div>
                    </a>
                @endauth
            </div>
        </div>

        @if(session('success'))
            <div style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Mobile Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        }

        if(openSidebarBtn) openSidebarBtn.addEventListener('click', toggleSidebar);
        if(closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
        if(sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);
        // Global Delete Confirmation
        document.addEventListener('submit', function(e) {
            if (e.target && e.target.classList.contains('delete-form')) {
                e.preventDefault();
                const form = e.target;
                
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#1e3a5f',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    background: '#ffffff',
                    customClass: {
                        popup: 'glass-card'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        // Optional: Flash Message to SweetAlert
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#0066cc',
                timer: 3000
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
</body>
</html>