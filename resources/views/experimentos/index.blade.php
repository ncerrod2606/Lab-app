@extends('layouts.scientific')

@section('title', 'Bitácora de Experimentos')

@section('content')
@section('content')
<div class="row mb-5">
    <div class="col-12 mb-4 d-flex justify-content-between align-items-center animate-fade-up">
        <h2 class="font-weight-800 text-dark mb-0">Bitácora Experimental</h2>
        <a href="{{ route('experimentos.create') }}" class="btn btn-primary shadow-lg"><i class="fas fa-flask mr-2"></i>Registrar Experimento</a>
    </div>

    <!-- Cards View -->
    <div class="col-12 mb-5">
        <h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-100"><i class="fas fa-th-large mr-2"></i>Vista de Tarjetas</h5>
        <div class="row">
            @forelse($experimentos as $index => $experimento)
            <div class="col-md-6 col-lg-4 mb-4 animate-fade-up" style="animation-delay: {{ $index * 0.1 + 0.2 }}s;">
                <div class="card h-100 border-0 shadow-sm p-4 d-flex flex-column position-relative" style="transition: transform 0.3s ease, box-shadow 0.3s ease; background: #ffffff; border-radius: 16px;">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="badge bg-dark text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.75rem;">Exp #{{ $experimento->id }}</span>
                        <span class="text-muted font-weight-bold small" style="font-size: 0.8rem;">{{ \Carbon\Carbon::parse($experimento->fecha)->format('d M, Y') }}</span>
                    </div>

                    <h4 class="font-weight-bold text-dark mb-2">
                        <a href="{{ route('experimentos.show', $experimento) }}" class="text-dark text-decoration-none stretched-link">{{ $experimento->nombre }}</a>
                    </h4>

                    <div class="mb-4">
                        <small class="text-muted d-block text-uppercase font-weight-bold" style="font-size: 0.7rem;">Proyecto</small>
                         @if($experimento->proyecto)
                            <span class="text-secondary font-weight-500">{{ $experimento->proyecto->titulo }}</span>
                         @else
                            <span class="text-muted font-italic">No asignado</span>
                         @endif
                    </div>

                    <div class="mt-auto d-flex justify-content-between align-items-end border-top pt-3">
                         <div class="text-muted small">
                             <i class="fas fa-microscope mr-1"></i> {{ $experimento->equipos->count() }} Equipos
                         </div>
                        <i class="fas fa-arrow-right text-primary"></i>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 animate-fade-up delay-200">
                 <div class="alert alert-light border-0 shadow-sm text-center py-4">
                    <i class="fas fa-vial fa-2x text-muted mb-2"></i>
                    <p class="mb-0 text-muted">No hay experimentos registrados.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-300"><i class="fas fa-list mr-2"></i>Vista de Lista</h5>
<div class="card animate-fade-up delay-300">
        <div class="card-header">
            <span>Experimentos Realizados</span>
            <a href="{{ route('experimentos.create') }}" class="btn btn-primary">Registrar Experimento</a>
        </div>
        <div class="table-responsive">
            <table class="table hover-table">
                <thead>
                    <tr>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Nombre</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Proyecto</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Equipos</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Fecha</th>
                        <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($experimentos as $experimento)
                    <tr>
                        <td class="font-weight-bold text-dark align-middle">{{ $experimento->nombre }}</td>
                        <td class="align-middle">
                            @if($experimento->proyecto)
                                <a href="{{ route('proyectos.edit', $experimento->proyecto) }}" class="text-primary font-weight-500">{{ $experimento->proyecto->titulo }}</a>
                            @else
                                <span class="text-muted font-italic">-</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($experimento->equipos->isNotEmpty())
                                @foreach($experimento->equipos as $eq)
                                    <span class="badge badge-light border text-secondary font-weight-normal mr-1">{{ $eq->nombre }}</span>
                                @endforeach
                            @else
                                <span class="text-muted font-italic">-</span>
                            @endif
                        </td>
                        <td class="align-middle text-muted small font-weight-bold">{{ $experimento->fecha }}</td>
                        <td class="align-middle text-right">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('experimentos.show', $experimento) }}" class="btn btn-info btn-sm text-white font-weight-bold shadow-sm">Ver</a>
                                <a href="{{ route('experimentos.edit', $experimento) }}" class="btn btn-primary btn-sm font-weight-bold shadow-sm">Editar</a>
                                <form action="{{ route('experimentos.destroy', $experimento) }}" method="POST" class="delete-form d-inline">
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
