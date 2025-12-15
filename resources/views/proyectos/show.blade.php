@extends('layouts.scientific')

@section('title', 'Detalles del Proyecto')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card glass-card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="text-primary mb-0"><i class="fas fa-project-diagram mr-2"></i> {{ $proyecto->titulo }}</h2>
                    <span class="badge {{ $proyecto->estado == 'completado' ? 'badge-success' : ($proyecto->estado == 'en_progreso' ? 'badge-warning' : 'badge-secondary') }}" style="font-size: 1rem; padding: 10px 20px; border-radius: 20px;">
                        {{ ucfirst(str_replace('_', ' ', $proyecto->estado)) }}
                    </span>
                </div>
                
                <p class="lead text-dark">{{ $proyecto->descripcion }}</p>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="info-box p-3 rounded" style="background: rgba(var(--primary-rgb), 0.1); border-left: 4px solid var(--primary);">
                            <h6 class="text-uppercase text-muted mb-2" style="font-size: 0.8rem; letter-spacing: 1px;">Cronograma</h6>
                            <p class="mb-1"><strong><i class="far fa-calendar-alt"></i> Inicio:</strong> {{ $proyecto->fecha_inicio }}</p>
                            <p class="mb-0"><strong><i class="far fa-calendar-check"></i> Fin:</strong> {{ $proyecto->fecha_fin ?: 'En curso' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="info-box p-3 rounded" style="background: rgba(var(--secondary-rgb), 0.1); border-left: 4px solid var(--secondary);">
                            <h6 class="text-uppercase text-muted mb-2" style="font-size: 0.8rem; letter-spacing: 1px;">Identificador</h6>
                            <p class="mb-0" style="font-family: monospace; font-size: 1.2rem;">PROJ-{{ str_pad($proyecto->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card glass-card h-100">
            <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="text-secondary font-weight-bold"><i class="fas fa-users-cog"></i> Equipo de Investigación</h5>
            </div>
            <div class="card-body">
                @if($proyecto->investigadores->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-user-slash fa-2x mb-2"></i>
                        <p>No hay investigadores asignados.</p>
                    </div>
                @else
                    <div class="list-group list-group-flush">
                        @foreach($proyecto->investigadores as $inv)
                            <a href="{{ route('investigadores.show', $inv) }}" class="list-group-item list-group-item-action bg-transparent border-light d-flex align-items-center">
                                <div class="mr-3">
                                    @if($inv->imagen)
                                        <img src="{{ route('imagen', $inv->id) }}?v={{ $inv->updated_at->timestamp }}" class="rounded-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
                                            {{ substr($inv->nombre, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-dark">{{ $inv->nombre }}</h6>
                                    <small class="text-muted">{{ $inv->especialidad }}</small>
                                </div>
                                <i class="fas fa-chevron-right text-muted" style="font-size: 0.8rem;"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="card glass-card h-100">
             <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="text-info font-weight-bold"><i class="fas fa-flask"></i> Experimentos Relacionados</h5>
            </div>
            <div class="card-body">
                @if($proyecto->experimentos->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-vial fa-2x mb-2"></i>
                        <p>No se han registrado experimentos.</p>
                    </div>
                @else
                    <div class="timeline">
                        @foreach($proyecto->experimentos as $exp)
                            <div class="media mb-3 pb-3 border-bottom border-light">
                                <div class="mr-3 text-center" style="width: 50px;">
                                    <span class="text-muted small d-block">{{ \Carbon\Carbon::parse($exp->fecha)->format('M') }}</span>
                                    <span class="h5 font-weight-bold text-dark d-block mb-0">{{ \Carbon\Carbon::parse($exp->fecha)->format('d') }}</span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1"><a href="{{ route('experimentos.show', $exp) }}" class="text-dark">{{ $exp->nombre }}</a></h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($exp->objetivo, 60) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

        
    </div>

    
</div>

<div class="row mt-4">
    <div class="col-12 text-right">
        <a href="{{ route('proyectos.edit', $proyecto) }}" class="btn btn-primary shadow-sm"><i class="fas fa-edit"></i> Editar Proyecto</a>
    </div>
</div>
@endsection
