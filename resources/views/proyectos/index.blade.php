@extends('layouts.scientific')

@section('title', 'Proyectos de Investigación')

@section('content')
@section('content')
<div class="row mb-5">
    <div class="col-12 mb-4 d-flex justify-content-between align-items-center animate-fade-up">
        <h2 class="font-weight-800 text-dark mb-0">Proyectos de Investigación</h2>
        <a href="{{ route('proyectos.create') }}" class="btn btn-primary shadow-lg"><i class="fas fa-plus mr-2"></i>Nuevo Proyecto</a>
    </div>

    <!-- Cards View -->
    <div class="col-12 mb-5">
        <h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-100"><i class="fas fa-th-large mr-2"></i>Vista de Tarjetas</h5>
        <div class="row">
            @forelse($proyectos as $index => $proyecto)
            <div class="col-md-6 col-lg-4 mb-4 animate-fade-up" style="animation-delay: {{ $index * 0.1 + 0.2 }}s;">
                <div class="card h-100 border-0 shadow-sm p-4 d-flex flex-column position-relative" style="transition: transform 0.3s ease, box-shadow 0.3s ease; background: #ffffff; border-radius: 16px;">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        @if($proyecto->estado == 'en_progreso')
                            <span class="badge bg-secondary text-white px-3 py-2 rounded-pill shadow-sm" style="background-color: #6c757d !important; font-size: 0.75rem;">En Progreso</span>
                        @elseif($proyecto->estado == 'completado')
                             <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.75rem;">Completado</span>
                        @else
                             <span class="badge bg-dark text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.75rem;">{{ ucfirst($proyecto->estado) }}</span>
                        @endif
                        <span class="text-muted font-weight-bold small" style="font-size: 0.8rem;">{{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('M Y') }}</span>
                    </div>

                    <h4 class="font-weight-bold text-dark mb-2">
                        <a href="{{ route('proyectos.show', $proyecto) }}" class="text-dark text-decoration-none stretched-link">{{ $proyecto->titulo }}</a>
                    </h4>
                    
                    <p class="text-muted small mb-4" style="color: #6c757d;">
                        {{ Str::limit($proyecto->descripcion ?? 'Sin descripción.', 100) }}
                    </p>

                    <div class="mt-auto d-flex justify-content-between align-items-end">
                         <!-- Avatars -->
                         <div class="d-flex pl-2">
                            @if($proyecto->investigadores->isNotEmpty())
                                @foreach($proyecto->investigadores->take(3) as $investigador)
                                    <div class="rounded-circle border border-white bg-secondary d-flex justify-content-center align-items-center text-white small shadow-sm"
                                         style="width: 32px; height: 32px; margin-left: -12px; font-size: 0.75rem;"
                                         title="{{ $investigador->nombre }}" data-toggle="tooltip">
                                         @if($investigador->imagen)
                                            <img src="{{ route('imagen', $investigador->id) }}?v={{ $investigador->updated_at->timestamp }}" 
                                                 class="rounded-circle w-100 h-100" style="object-fit: cover;">
                                         @else
                                            {{ substr($investigador->nombre, 0, 1) }}
                                         @endif
                                    </div>
                                @endforeach
                            @else
                                <span class="text-muted small">Sin equipo</span>
                            @endif
                        </div>
                        <i class="fas fa-arrow-right text-primary"></i>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 animate-fade-up delay-200">
                <div class="alert alert-light border-0 shadow-sm text-center py-4">
                    <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
                    <p class="mb-0 text-muted">No hay proyectos para mostrar en tarjetas.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-300"><i class="fas fa-list mr-2"></i>Vista de Lista</h5>
<!-- Table Card (Original) -->
<div class="card animate-fade-up delay-300">
        <div class="card-header">
            <span>Listado de Proyectos</span>
            <a href="{{ route('proyectos.create') }}" class="btn btn-primary">Nuevo Proyecto</a>
        </div>
        <div class="table-responsive">
            <table class="table hover-table">
                <thead>
                    <tr>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Título</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Estado</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Inicio</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Fin</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyectos as $proyecto)
                    <tr>
                        <td class="font-weight-bold text-dark align-middle">{{ $proyecto->titulo }}</td>
                        <td class="align-middle">
                            @if($proyecto->estado == 'en_progreso')
                                <span class="badge badge-warning text-white px-3 py-2 rounded-pill shadow-sm">En Progreso</span>
                            @elseif($proyecto->estado == 'completado')
                                <span class="badge badge-success px-3 py-2 rounded-pill shadow-sm">Completado</span>
                            @else
                                <span class="badge badge-light border text-secondary px-3 py-2 rounded-pill">{{ ucfirst($proyecto->estado) }}</span>
                            @endif
                        </td>
                        <td class="align-middle text-muted small font-weight-bold">{{ $proyecto->fecha_inicio }}</td>
                        <td class="align-middle text-muted small font-weight-bold">{{ $proyecto->fecha_fin ?? '-' }}</td>
                        <td class="align-middle text-right">
                             <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('proyectos.show', $proyecto) }}" class="btn btn-info btn-sm text-white font-weight-bold shadow-sm">Ver</a>
                                <a href="{{ route('proyectos.edit', $proyecto) }}" class="btn btn-primary btn-sm font-weight-bold shadow-sm">Editar</a>
                                 <form action="{{ route('proyectos.destroy', $proyecto) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm font-weight-bold shadow-sm">Borrar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
