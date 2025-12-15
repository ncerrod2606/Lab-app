@extends('layouts.scientific')

@section('title', 'Investigadores')

@section('content')
@section('content')
<div class="row mb-5">
    <div class="col-12 mb-4 d-flex justify-content-between align-items-center animate-fade-up">
        <h2 class="font-weight-800 text-dark mb-0">Equipo Científico</h2>
        <a href="{{ route('investigadores.create') }}" class="btn btn-primary shadow-lg"><i class="fas fa-user-plus mr-2"></i>Registrar Investigador</a>
    </div>

    <!-- Cards View -->
    <div class="col-12 mb-5">
        <h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-100"><i class="fas fa-id-card mr-2"></i>Vista de Tarjetas</h5>
        <div class="row">
            @forelse($investigadores as $index => $investigador)
            <div class="col-md-6 col-lg-3 mb-4 animate-fade-up" style="animation-delay: {{ $index * 0.1 + 0.2 }}s;">
                <div class="glass-card h-100 text-center position-relative overflow-hidden" 
                     style="transition: transform 0.3s ease; border-top: 4px solid var(--primary-color);">
                    <div class="card-body p-4">
                        <div class="mb-4 position-relative d-inline-block">
                             @if($investigador->imagen)
                                <img src="{{ route('imagen', $investigador->id) }}?v={{ $investigador->updated_at->timestamp }}" 
                                     alt="{{ $investigador->nombre }}" 
                                     class="rounded-circle shadow-lg" 
                                     style="width: 100px; height: 100px; object-fit: cover; border: 3px solid white;">
                            @else
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 100px; height: 100px; font-size: 1.2rem;">
                                            {{ substr($investigador->nombre, 0, 1) }}
                                        </div>
                            @endif
                        </div>

                        <h5 class="font-weight-bold text-dark mb-1 text-truncate" title="{{ $investigador->nombre }}">
                            <a href="{{ route('investigadores.show', $investigador) }}" class="text-dark text-decoration-none stretched-link">{{ $investigador->nombre }}</a>
                        </h5>
                        <p class="text-primary small font-weight-bold mb-3">{{ $investigador->especialidad }}</p>
                        
                        <div class="d-flex justify-content-center align-items-center mb-0">
                           <span class="badge badge-light px-3 py-2 border shadow-sm">
                               <i class="fas fa-project-diagram mr-2 text-secondary"></i> {{ $investigador->proyectos->count() }} Proyectos
                           </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 animate-fade-up delay-200">
                 <div class="alert alert-light border-0 shadow-sm text-center py-4">
                    <i class="fas fa-users-slash fa-2x text-muted mb-2"></i>
                    <p class="mb-0 text-muted">No hay investigadores registrados.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-300"><i class="fas fa-list mr-2"></i>Vista de Lista</h5>
<div class="card animate-fade-up delay-300">
        <div class="card-header">
            <span>Lista de Investigadores</span>
            <a href="{{ route('investigadores.create') }}" class="btn btn-primary">Nuevo Investigador</a>
        </div>
        <div class="table-responsive">
            <table class="table hover-table">
                <thead>
                    <tr>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Nombre</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Especialidad</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Email</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investigadores as $investigador)
                    <tr>
                        <td class="font-weight-bold text-dark align-middle">{{ $investigador->nombre }}</td>
                        <td class="align-middle"><div class="badge badge-light border text-secondary">{{ $investigador->especialidad }}</div></td>
                        <td class="align-middle">{{ $investigador->email }}</td>
                        <td class="align-middle text-right">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('investigadores.show', $investigador) }}" class="btn btn-info btn-sm text-white font-weight-bold shadow-sm" title="Ver Detalle">Ver</a>
                                <a href="{{ route('investigadores.edit', $investigador) }}" class="btn btn-primary btn-sm font-weight-bold shadow-sm" title="Editar">Editar</a>
                                <form action="{{ route('investigadores.destroy', $investigador) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm font-weight-bold shadow-sm" title="Eliminar">Borrar</button>
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
