@extends('layouts.scientific')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-lg overflow-hidden">
             <div class="card-body p-5 bg-white text-dark position-relative overflow-hidden">
                <div class="position-relative z-1">
                    <h1 class="font-weight-800 mb-2">Panel de Control Científico</h1>
                    <p class="lead mb-4" style="opacity: 0.9;">Bienvenido al sistema de gestión. Seleccione una operación para comenzar.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('experimentos.create') }}" class="btn btn-light text-primary font-weight-bold shadow-sm"><i class="fas fa-plus mr-2"></i>Nuevo Experimento</a>
                        <a href="{{ route('notas.create') }}" class="btn btn-outline-dark font-weight-bold"><i class="fas fa-edit mr-2" ></i>Registrar Nota</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5">
    <!-- Stat Cards -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="glass-card h-100 p-4 d-flex align-items-center justify-content-between shadow-sm hover-lift transition-all">
            <div>
                <h6 class="text-secondary text-uppercase font-weight-bold text-xs letter-spacing-1 mb-1">Investigadores</h6>
                <div class="h3 font-weight-800 text-dark mb-0">{{ \App\Models\Investigador::count() }}</div>
            </div>
            <div class="icon-box bg-light text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="fas fa-users fa-lg"></i>
            </div>
            <a href="{{ route('investigadores.index') }}" class="stretched-link"></a>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="glass-card h-100 p-4 d-flex align-items-center justify-content-between shadow-sm hover-lift transition-all">
             <div>
                <h6 class="text-secondary text-uppercase font-weight-bold text-xs letter-spacing-1 mb-1">Proyectos Activos</h6>
                <div class="h3 font-weight-800 text-dark mb-0">{{ \App\Models\Proyecto::count() }}</div>
            </div>
             <div class="icon-box bg-light text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="fas fa-project-diagram fa-lg"></i>
            </div>
            <a href="{{ route('proyectos.index') }}" class="stretched-link"></a>
        </div>
    </div>

     <div class="col-md-6 col-lg-3 mb-4">
        <div class="glass-card h-100 p-4 d-flex align-items-center justify-content-between shadow-sm hover-lift transition-all">
             <div>
                <h6 class="text-secondary text-uppercase font-weight-bold text-xs letter-spacing-1 mb-1">Experimentos</h6>
                <div class="h3 font-weight-800 text-dark mb-0">{{ \App\Models\Experimento::count() }}</div>
            </div>
             <div class="icon-box bg-light text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="fas fa-flask fa-lg"></i>
            </div>
            <a href="{{ route('experimentos.index') }}" class="stretched-link"></a>
        </div>
    </div>

     <div class="col-md-6 col-lg-3 mb-4">
        <div class="glass-card h-100 p-4 d-flex align-items-center justify-content-between shadow-sm hover-lift transition-all">
             <div>
                <h6 class="text-secondary text-uppercase font-weight-bold text-xs letter-spacing-1 mb-1">Notas de Lab</h6>
                <div class="h3 font-weight-800 text-dark mb-0">{{ \App\Models\NotaInvestigacion::count() }}</div>
            </div>
             <div class="icon-box bg-light text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="fas fa-book fa-lg"></i>
            </div>
            <a href="{{ route('notas.index') }}" class="stretched-link"></a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Content Area -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-lg h-100">
            <div class="card-header bg-white p-4 border-bottom">
                <h5 class="font-weight-bold mb-0 text-dark"><i class="fas fa-history mr-2 text-primary"></i>Actividad Reciente</h5>
            </div>
            <div class="card-body p-0">
                @if(isset($recentNotes) && $recentNotes->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentNotes as $note)
                            <a href="{{ route('notas.show', $note) }}" class="list-group-item list-group-item-action p-4 border-bottom hover-bg-light transition-all">
                                <div class="d-flex w-100 justify-content-between mb-2">
                                    <h6 class="mb-1 font-weight-bold text-dark">{{ $note->experimento->nombre ?? 'Experimento desconocido' }}</h6>
                                    <small class="text-muted font-weight-bold">{{ $note->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1 text-secondary small">{{ Str::limit($note->contenido, 100) }}</p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center p-5">
                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3 opacity-50"></i>
                        <p class="text-muted">No hay actividad reciente.</p>
                    </div>
                @endif
            </div>
            <div class="card-footer bg-light p-3 text-center border-0">
                <a href="{{ route('notas.index') }}" class="text-primary font-weight-bold small text-uppercase letter-spacing-1 text-decoration-none">Ver todas las notas <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Sidebar actions -->
    <div class="col-lg-4 mb-4">
        <div class="card glass-card border-0 mb-4 bg-white text-dark p-4 shadow-sm">
            <h5 class="font-weight-bold mb-3"><i class="fas fa-bolt text-warning mr-2"></i>Acciones Rápidas</h5>
            <div class="d-flex flex-column gap-3">
                <a href="{{ route('proyectos.create') }}" class="btn btn-outline-dark text-left p-3 d-flex align-items-center border-0 bg-white-10 hover-bg-white-20 transition-all rounded-lg">
                    <div class="rounded-circle bg-success d-flex align-items-center justify-content-center mr-3" style="width: 32px; height: 32px;">
                        <i class="fas fa-plus text-white small"></i>
                    </div>
                    <span>Iniciar Proyecto</span>
                </a>
                <a href="{{ route('investigadores.create') }}" class="btn btn-outline-dark text-left p-3 d-flex align-items-center border-0 bg-white-10 hover-bg-white-20 transition-all rounded-lg">
                     <div class="rounded-circle bg-info d-flex align-items-center justify-content-center mr-3" style="width: 32px; height: 32px;">
                        <i class="fas fa-user-plus text-white small"></i>
                    </div>
                    <span>Registrar Investigador</span>
                </a>
                 <a href="{{ route('equipos.create') }}" class="btn btn-outline-dark text-left p-3 d-flex align-items-center border-0 bg-white-10 hover-bg-white-20 transition-all rounded-lg">
                     <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center mr-3" style="width: 32px; height: 32px;">
                        <i class="fas fa-box text-white small"></i>
                    </div>
                    <span>Nuevo Equipo</span>
                </a>
            </div>
        </div>

        <div class="glass-card p-4">
             <h6 class="text-uppercase text-secondary font-weight-bold mb-3 small letter-spacing-1">Estado del Sistema</h6>
             <ul class="list-unstyled mb-0">
                 <li class="d-flex justify-content-between align-items-center mb-3">
                     <span class="text-muted small"><i class="fas fa-server mr-2"></i>Servidor</span>
                     <span class="badge badge-success px-2 py-1 rounded-pill"><i class="fas fa-circle small mr-1"></i>En Linea</span>
                 </li>
                 <li class="d-flex justify-content-between align-items-center mb-3">
                     <span class="text-muted small"><i class="fas fa-database mr-2"></i>Base de Datos</span>
                     <span class="badge badge-success px-2 py-1 rounded-pill"><i class="fas fa-circle small mr-1"></i>Conectado</span>
                 </li>
                  <li class="d-flex justify-content-between align-items-center">
                     <span class="text-muted small"><i class="fas fa-clock mr-2"></i>Última Actividad</span>
                     <span class="text-dark small font-weight-bold">Hace 5 min</span>
                 </li>
             </ul>
        </div>
    </div>
</div>
@endsection
