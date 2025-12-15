@extends('layouts.scientific')

@section('title', 'Inventario de Equipos')

@section('content')
@section('content')
<div class="row mb-5">
    <div class="col-12 mb-4 d-flex justify-content-between align-items-center animate-fade-up">
        <h2 class="font-weight-800 text-dark mb-0">Inventario de Equipos</h2>
        <a href="{{ route('equipos.create') }}" class="btn btn-primary shadow-lg"><i class="fas fa-microscope mr-2"></i>Registrar Equipo</a>
    </div>

    <!-- Cards View -->
    <div class="col-12 mb-5">
        <h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-100"><i class="fas fa-boxes mr-2"></i>Vista de Tarjetas</h5>
        <div class="row">
            @forelse($equipos as $index => $equipo)
            <div class="col-md-6 col-lg-3 mb-4 animate-fade-up" style="animation-delay: {{ $index * 0.1 + 0.2 }}s;">
                <div class="glass-card h-100 text-center position-relative overflow-hidden p-4 d-flex flex-column" 
                     style="transition: transform 0.3s ease; border-bottom: 4px solid {{ $equipo->estado == 'disponible' ? '#28a745' : ($equipo->estado == 'en_uso' ? '#ffc107' : '#dc3545') }};">
                    
                    <div class="mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                             style="width: 60px; height: 60px; background-color: {{ $equipo->estado == 'disponible' ? '#e8f5e9' : ($equipo->estado == 'en_uso' ? '#fff9c4' : '#f8d7da') }}; color: {{ $equipo->estado == 'disponible' ? '#1b5e20' : ($equipo->estado == 'en_uso' ? '#f57f17' : '#b71c1c') }}">
                            <i class="fas fa-microscope fa-lg"></i>
                        </div>
                    </div>

                    <h5 class="font-weight-bold text-dark mb-1">
                        <a href="{{ route('equipos.show', $equipo) }}" class="text-dark text-decoration-none stretched-link">{{ $equipo->nombre }}</a>
                    </h5>
                    <p class="text-muted small text-uppercase font-weight-bold mb-2">{{ $equipo->tipo }}</p>

                    @if($equipo->estado == 'en_uso' && $equipo->experimentos->isNotEmpty())
                        <div class="small text-secondary mb-3">
                            <i class="fas fa-flask mr-1"></i> 
                            @foreach($equipo->experimentos as $exp)
                                <span>{{ $exp->nombre }}</span>{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-auto">
                        @if($equipo->estado == 'disponible')
                            <span class="badge badge-success px-3 py-2 rounded-pill shadow-sm mb-3">Disponible</span>
                            <button type="button" class="btn btn-sm btn-outline-primary btn-block position-relative" style="z-index: 2;" data-toggle="modal" data-target="#assignModal" data-equipo-id="{{ $equipo->id }}" data-equipo-name="{{ $equipo->nombre }}">
                                Asignar
                            </button>
                        @elseif($equipo->estado == 'en_uso')
                            <span class="badge badge-warning text-white px-3 py-2 rounded-pill shadow-sm mb-3">En Uso</span>
                            <form action="{{ route('equipos.liberar', $equipo) }}" method="POST" class="d-block position-relative" style="z-index: 2;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-secondary btn-block">Liberar</button>
                            </form>
                        @else
                            <span class="badge badge-danger px-3 py-2 rounded-pill shadow-sm">Mantenimiento</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 animate-fade-up delay-200">
                 <div class="alert alert-light border-0 shadow-sm text-center py-4">
                    <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                    <p class="mb-0 text-muted">No hay equipos registrados.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-300"><i class="fas fa-list mr-2"></i>Vista de Lista</h5>
<div class="card animate-fade-up delay-300">
    <div class="card-header">
        <span>Recursos Disponibles</span>
        <a href="{{ route('equipos.create') }}" class="btn btn-primary">Registrar Equipo</a>
    </div>
    <div class="table-responsive">
        <table class="table hover-table">
            <thead>
                <tr>
                    <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Nombre</th>
                    <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Tipo</th>
                    <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase">Estado/Asignado</th>
                    <th class="border-0 bg-light text-secondary font-weight-bold small text-uppercase text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipos as $equipo)
                <tr>
                    <td class="font-weight-bold text-dark align-middle">{{ $equipo->nombre }}</td>
                    <td class="align-middle"><div class="badge badge-light border text-secondary">{{ $equipo->tipo }}</div></td>
                    <td class="align-middle">
                        @if($equipo->estado == 'disponible')
                            <span class="tag" style="background:#d4edda; color:#155724;">Disponible</span>
                        @elseif($equipo->estado == 'en_uso')
                            <span class="tag" style="background:#fff3cd; color:#856404;">En Uso</span>
                            @if($equipo->experimentos->isNotEmpty())
                                 <div class="small text-muted mt-1">
                                    <i class="fas fa-flask"></i> 
                                    @foreach($equipo->experimentos as $exp)
                                        {{ $exp->nombre }}{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                </div>
                            @elseif($equipo->investigador)
                                 <div class="small text-muted mt-1"><i class="fas fa-user-circle"></i> {{ $equipo->investigador->nombre }}</div>
                            @endif
                        @else
                            <span class="tag" style="background:#f8d7da; color:#721c24;">Mantenimiento</span>
                        @endif
                    </td>
                    <td class="align-middle text-right">
                         <div class="d-flex justify-content-end gap-2">
                            @if($equipo->estado == 'disponible')
                                 <button type="button" class="btn btn-sm btn-outline-success border-0" data-toggle="modal" data-target="#assignModal" data-equipo-id="{{ $equipo->id }}" data-equipo-name="{{ $equipo->nombre }}" title="Asignar">
                                    <i class="fas fa-link"></i>
                                </button>
                            @elseif($equipo->estado == 'en_uso')
                                <form action="{{ route('equipos.liberar', $equipo) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-warning text-warning border-0" title="Liberar">
                                        <i class="fas fa-unlink"></i>
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('equipos.show', $equipo) }}" class="btn btn-info btn-sm text-white font-weight-bold shadow-sm">Ver</a>
                            <a href="{{ route('equipos.edit', $equipo) }}" class="btn btn-primary btn-sm font-weight-bold shadow-sm">Editar</a>
                            <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" class="delete-form d-inline">
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

<!-- Assign Modal -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content glass-card border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title font-weight-bold text-dark">Asignar Equipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="assignForm" action="" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <p class="text-muted mb-4">Asignar <strong id="modalEquipoName" class="text-dark"></strong> a uno o más experimentos:</p>
            <div class="form-group">
                <label for="experimento_ids" class="form-label small text-uppercase font-weight-bold">Experimentos</label>
                <select name="experimento_ids[]" id="experimento_ids" class="form-control custom-select shadow-sm" multiple required style="min-height: 150px;">
                    @foreach($experimentos as $exp)
                        <option value="{{ $exp->id }}">{{ $exp->nombre }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted mt-2">Mantenga presionado Ctrl (o Cmd) para seleccionar múltiples.</small>
            </div>
          </div>
          <div class="modal-footer border-0 bg-light">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success shadow-sm">Confirmar Asignación</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#assignModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var equipoId = button.data('equipo-id');
            var equipoName = button.data('equipo-name');
            var modal = $(this);
            
            modal.find('#modalEquipoName').text(equipoName);
            var actionUrl = "{{ route('equipos.asignar', ':id') }}";
            actionUrl = actionUrl.replace(':id', equipoId);
            modal.find('#assignForm').attr('action', actionUrl);
        });
    });
</script>
@endsection
