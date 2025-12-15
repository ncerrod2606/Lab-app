@extends('layouts.scientific')

@section('title', 'Detalle Experimental')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 overflow-hidden shadow-lg">
            <div class="card-header bg-white text-dark p-5 position-relative overflow-hidden">
                <!-- Abstract Background -->
            
                
                <div class="position-relative z-1">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            
                            <h1 class="font-weight-800 text-dark mb-2 animate-fade-up delay-100" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);">{{ $experimento->nombre }}</h1>
                            <div class="d-flex align-items-center text-dark animate-fade-up delay-200">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span class="text-uppercase letter-spacing-1 font-weight-bold">{{ \Carbon\Carbon::parse($experimento->fecha)->format('d F, Y') }}</span>
                            </div>
                        </div>
                        <div class="d-flex gap-2 animate-fade-up delay-200">
                            <a href="{{ route('experimentos.edit', $experimento) }}" class="btn btn-light shadow-sm text-primary font-weight-bold" ><i class="fas fa-edit mr-2"></i>Editar</a>
                            <a href="{{ route('experimentos.index') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left mr-2"></i>Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left Column: Scientific Data -->
    <div class="col-lg-8 animate-fade-up delay-300">
        <!-- Project Context -->
        <div class="glass-card p-4 mb-4 border-left-primary position-relative overflow-hidden card shadow-lg mb-4 border-0" style="border-left: 5px solid var(--primary);">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <small class="text-uppercase text-secondary font-weight-bold letter-spacing-1 ">Proyecto Vinculado</small>
                    <h4 class="mb-0 mt-1 font-weight-bold ml-1">
                        <a href="{{ route('proyectos.show', $experimento->proyecto) }}" class="text-dark hover-primary">{{ $experimento->proyecto->titulo }}</a>
                    </h4>
                </div>
            </div>
        </div>

        <!-- Technical Report -->
        <div class="card shadow-lg mb-4 border-0">
             <div class="card-header bg-white border-bottom p-4">
                <h5 class="text-primary font-weight-bold mb-0 d-flex align-items-center">
                    Informe Técnico
                </h5>
            </div>
            <div class="card-body p-4 bg-light">
                <div class="bg-white p-4 rounded-lg shadow-sm mb-4 border-left-4 border-primary" style="border-left: 4px solid var(--primary);">
                    <h6 class="text-secondary font-weight-bold text-uppercase mb-3 d-flex align-items-center">
                        <i class="fas fa-bullseye mr-2 text-primary"></i> Objetivo
                    </h6>
                    <p class="mb-0 text-dark lead" style="font-size: 1.05rem;">
                        {{ $experimento->objetivo ?: 'Sin objetivo definido.' }}
                    </p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border-left-4 border-success" style="border-left: 4px solid var(--success);">
                    <h6 class="text-secondary font-weight-bold text-uppercase mb-3 d-flex align-items-center">
                        <i class="fas fa-flask mr-2 text-success"></i> Resultados
                    </h6>
                    @if($experimento->resultados)
                        <p class="mb-0 text-dark lead" style="font-size: 1.05rem;">
                            {{ $experimento->resultados }}
                        </p>
                    @else
                         <p class="text-muted font-italic mb-0">Resultados pendientes de ingreso.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Resources & Logs -->
    <div class="col-lg-4 animate-fade-up delay-400">
        <!-- Equipment Card -->
        <div class="card shadow-lg mb-4 border-0 overflow-hidden">
            <div class="card-header bg-white text-dark p-3 border-0">
                 <h6 class="font-weight-bold mb-0 text-uppercase letter-spacing-1"><i class="fas fa-tools mr-2 text-warning"></i> Recursos Asignados</h6>
            </div>
            <div class="card-body p-0">
                @if($experimento->equipos->isEmpty())
                     <div class="text-center py-4 bg-light">
                        <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                        <p class="mb-0 text-muted small">Sin equipo asignado</p>
                    </div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($experimento->equipos as $equipo)
                            <li class="list-group-item d-flex justify-content-between align-items-center hover-bg-light transition-all border-bottom-light p-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 bg-light text-primary border" style="width: 40px; height: 40px;">
                                        <i class="fas fa-microscope"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 font-weight-bold text-dark">{{ $equipo->nombre }}</h6>
                                        <small class="text-muted text-uppercase" style="font-size: 0.7rem;">{{ $equipo->tipo }}</small>
                                    </div>
                                </div>
                                <span class="badge {{ $equipo->estado == 'disponible' ? 'badge-success' : ($equipo->estado == 'en_uso' ? 'badge-warning text-white' : 'badge-danger') }} shadow-sm">
                                    {{ ucfirst(str_replace('_', ' ', $equipo->estado)) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Logbook Timeline -->
        <div class="card shadow-lg border-0" style="min-height: 400px;">
             <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <h6 class="font-weight-bold mb-0 text-uppercase letter-spacing-1 text-primary"><i class="fas fa-history mr-2"></i> Bitácora</h6>
                <a href="{{ route('notas.create', ['experimento_id' => $experimento->id]) }}" class="btn btn-primary btn-sm rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 32px; height: 45px;">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body p-4 bg-light" style="max-height: 500px; overflow-y: auto;">
                 @if($experimento->notas->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-book-reader fa-3x text-muted mb-3 opacity-50"></i>
                        <p class="text-muted small">No hay registros en la bitácora.</p>
                        <a href="{{ route('notas.create', ['experimento_id' => $experimento->id]) }}" class="btn btn-sm btn-outline-primary mt-2">Crear primera entrada</a>
                    </div>
                @else
                    <div class="timeline position-relative pl-3" style="border-left: 2px solid var(--border);">
                        @foreach($experimento->notas as $nota)
                            <div class="timeline-item position-relative mb-4 pl-4">
                                <div class="position-absolute bg-white border border-primary text-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 12px; height: 12px; left: -7px; top: 0.2rem;"></div>
                                <div class="card border-0 shadow-sm rounded-lg hover-lift transition-all">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between mb-2 border-bottom pb-2">
                                            <span class="badge badge-light text-primary font-weight-bold">{{ $nota->created_at->format('d M') }}</span>
                                            <small class="text-muted font-weight-bold">{{ $nota->created_at->format('H:i') }}</small>
                                        </div>
                                        <p class="mb-2 text-dark" style="font-size: 0.95rem; line-height: 1.5;">{{ Str::limit($nota->contenido, 100) }}</p>
                                        <a href="{{ route('notas.show', $nota) }}" class="text-primary small font-weight-bold text-decoration-none">Ver completo <i class="fas fa-arrow-right ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
