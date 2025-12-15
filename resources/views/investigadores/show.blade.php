@extends('layouts.scientific')

@section('title', 'Perfil del Investigador')

@section('content')
<div class="row">
    <div class="col-lg-4 text-center">
        <!-- Profile Card -->
        <div class="card glass-card mb-4 overflow-hidden">
            <div class="card-body pt-5">
                 <div class="mb-4 position-relative d-inline-block">
                    @if($investigador->imagen)
                        <img src="{{ route('imagen', $investigador->id) }}?v={{ $investigador->updated_at->timestamp }}" 
                             alt="Perfil" 
                             class="rounded-circle shadow-lg border-white" 
                             style="width: 160px; height: 160px; object-fit: cover; border: 4px solid var(--white-alpha);">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 160px; height: 160px; font-size: 2rem;">
                            {{ substr($investigador->nombre, 0, 1) }}
                        </div>
                    @endif
                 </div>
                 
                 <h3 class="font-weight-bold text-dark mb-1">{{ $investigador->nombre }}</h3>
                 <span class="badge badge-primary px-3 py-2 rounded-pill mt-2" style="font-size: 0.9rem;">{{ $investigador->especialidad }}</span>
                 
                 <div class="mt-4 pt-4 border-top">
                     <a href="mailto:{{ $investigador->email }}" class="text-secondary text-decoration-none">
                         <i class="fas fa-envelope mr-2"></i> {{ $investigador->email }}
                     </a>
                 </div>
            </div>
            <div class="card-footer bg-light p-3">
                 <div class="row">
                     <div class="col-6">
                         <a href="{{ route('investigadores.edit', $investigador) }}" class="btn btn-outline-primary btn-block"><i class="fas fa-pen"></i> Editar</a>
                     </div>
                     <div class="col-6">
                             <form action="{{ route('investigadores.destroy', $investigador) }}" method="POST" class="delete-form">
                                 @csrf 
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-outline-danger btn-block"><i class="fas fa-trash-alt"></i> Eliminar</button>
                             </form>
                     </div>
                 </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <!-- Bio Card -->
        <div class="card glass-card mb-4">
            <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="text-secondary font-weight-bold"><i class="fas fa-user-tag"></i> Biografía</h5>
            </div>
            <div class="card-body">
                <p class="lead text-dark" style="font-size: 1.1rem; line-height: 1.7;">
                    {{ $investigador->biografia ?: 'No se ha registrado información biográfica para este investigador.' }}
                </p>
            </div>
        </div>

        <!-- Projects Card -->
        <div class="card glass-card">
            <div class="card-header bg-transparent border-0 pb-0 d-flex justify-content-between align-items-center">
                <h5 class="text-primary font-weight-bold mb-0"><i class="fas fa-project-diagram"></i> Proyectos Asignados</h5>
                <span class="badge badge-pill badge-light shadow-sm">{{ $investigador->proyectos->count() }} Proyectos</span>
            </div>
            <div class="card-body">
                @if($investigador->proyectos->isEmpty())
                     <div class="text-center py-5 text-muted">
                        <i class="fas fa-clipboard-list fa-3x mb-3 text-secondary-light"></i>
                        <p>No participa en ningún proyecto activo.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 50%;">Proyecto</th>
                                    <th>Estado</th>
                                    <th>Rol Asignado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investigador->proyectos as $proyecto)
                                    <tr>
                                        <td class="font-weight-bold text-dark">{{ $proyecto->titulo }}</td>
                                        <td>
                                            @if($proyecto->estado == 'completado')
                                                <span class="badge badge-success">Completado</span>
                                            @elseif($proyecto->estado == 'en_progreso')
                                                <span class="badge badge-warning text-white">En Progreso</span>
                                            @else
                                                <span class="badge badge-secondary">Cancelado</span>
                                            @endif
                                        </td>
                                        <td><span class="text-muted"><i class="fas fa-user-check"></i> Investigador Principal</span></td>
                                        <td class="text-right">
                                            <a href="{{ route('proyectos.show', $proyecto) }}" class="btn btn-sm btn-light shadow-sm"><i class="fas fa-external-link-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
