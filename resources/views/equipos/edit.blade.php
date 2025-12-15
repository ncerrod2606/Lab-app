@extends('layouts.scientific')

@section('title', 'Editar Equipo')

@section('content')
    <div class="card">
        <div class="card-header">
            Actualizar Recurso
        </div>
        <form action="{{ route('equipos.update', $equipo) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Nombre del Equipo</label>
                <input type="text" name="nombre" class="form-control" value="{{ $equipo->nombre }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tipo</label>
                <input type="text" name="tipo" class="form-control" value="{{ $equipo->tipo }}" required>
            </div>
            <div class="form-group mb-4">
                <label class="form-label font-weight-bold">Estado Administrativo</label>
                <div class="d-flex align-items-center">
                    <div class="custom-control custom-radio mr-4">
                        <input type="radio" id="estado_operativo" name="estado_operativo" class="custom-control-input" value="operativo" {{ $equipo->estado != 'mantenimiento' ? 'checked' : '' }} onchange="toggleExperimentos(true)">
                        <label class="custom-control-label" for="estado_operativo">Operativo</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="estado_mantenimiento" name="estado_operativo" class="custom-control-input" value="mantenimiento" {{ $equipo->estado == 'mantenimiento' ? 'checked' : '' }} onchange="toggleExperimentos(false)">
                        <label class="custom-control-label" for="estado_mantenimiento">En Mantenimiento</label>
                    </div>
                </div>
            </div>

            <div id="experimentos-container" class="form-group mb-5" style="{{ $equipo->estado == 'mantenimiento' ? 'display:none;' : '' }}">
                <label class="form-label text-dark small font-weight-bold text-uppercase">Asignar a Experimentos (Opcional)</label>
                <div class="input-group shadow-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0 text-primary"><i class="fas fa-flask"></i></span>
                    </div>
                    <select name="experimentos[]" class="form-control custom-select border-left-0" multiple style="min-height: 120px;">
                        @foreach($experimentos as $experimento)
                            <option value="{{ $experimento->id }}" {{ $equipo->experimentos->contains($experimento->id) ? 'selected' : '' }}>
                                {{ $experimento->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted mt-2"><i class="fas fa-info-circle mr-1"></i> Si selecciona experimentos, el estado se establecerá automáticamente en <strong>"En Uso"</strong>. De lo contrario, será <strong>"Disponible"</strong>.</small>
            </div>

            <script>
                function toggleExperimentos(show) {
                    const container = document.getElementById('experimentos-container');
                    if (show) {
                        container.style.display = 'block';
                    } else {
                        container.style.display = 'none';
                    }
                }
            </script>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
