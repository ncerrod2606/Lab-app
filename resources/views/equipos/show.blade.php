@extends('layouts.scientific')

@section('title', 'Detalles del Equipo')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card glass-card text-center overflow-hidden">
            <div class="card-header bg-white text-dark py-4">
                <div class="icon-box mb-3">
                    <i class="fas fa-microscope fa-4x animate__animated animate__pulse animate__infinite"></i>
                </div>
                <h2 class="font-weight-bold">{{ $equipo->nombre }}</h2>
                <span class="badge badge-light text-primary text-uppercase" style="letter-spacing: 2px;">{{ $equipo->tipo }}</span>
            </div>
            <div class="card-body p-5">
                <div class="row mb-5">
                    <div class="col-md-6 border-right">
                        <h6 class="text-muted text-uppercase small">Estado Actual</h6>
                        @if($equipo->estado == 'disponible')
                             <h4 class="text-success"><i class="fas fa-check-circle"></i> Disponible</h4>
                        @elseif($equipo->estado == 'en_uso')
                             <h4 class="text-warning"><i class="fas fa-clock"></i> En Uso</h4>
                        @else
                             <h4 class="text-danger"><i class="fas fa-tools"></i> Mantenimiento</h4>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted text-uppercase small">Identificador de Activo</h6>
                        <h4 class="text-dark" style="font-family: monospace;">EQ-{{ str_pad($equipo->id, 5, '0', STR_PAD_LEFT) }}</h4>
                    </div>
                </div>

                <div class="text-left">
                    <h5 class="text-secondary border-bottom pb-2 mb-3"><i class="fas fa-flask"></i> Experimentos Asignados</h5>
                    @if($equipo->experimentos->isEmpty())
                        <div class="alert alert-light border-0 shadow-sm">
                            Este equipo aún no ha sido utilizado en ningún experimento registrado.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Experimento</th>
                                        <th>Fecha</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($equipo->experimentos as $exp)
                                        <tr>
                                            <td>{{ $exp->nombre }}</td>
                                            <td>{{ $exp->fecha }}</td>
                                            <td><a href="{{ route('experimentos.show', $exp) }}" class="btn btn-sm btn-outline-primary">Ver</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-light p-3">
                <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-primary btn-lg shadow-sm px-5"><i class="fas fa-edit"></i> Actualizar Equipo</a>
                <a href="{{ route('equipos.index') }}" class="btn btn-link text-muted ml-3">Volver al inventario</a>
            </div>
        </div>
    </div>
</div>
@endsection
