@extends('layouts.scientific')

@section('title', 'Nuevo Equipo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg overflow-hidden">
            <div class="card-header bg-white text-dark p-4">
                <h5 class="mb-0 font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>Registro de Recurso</h5>
            </div>
            <div class="card-body p-5 bg-light">
                <form action="{{ route('equipos.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="form-label text-dark small font-weight-bold text-uppercase">Nombre del Equipo</label>
                        <div class="input-group input-group-lg shadow-sm">
                             <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 text-primary"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" name="nombre" class="form-control border-left-0" placeholder="e.g. Microscopio Electrónico de Barrido" required>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label text-dark small font-weight-bold text-uppercase">Tipo / Categoría</label>
                        <div class="input-group input-group-lg shadow-sm">
                             <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 text-primary"><i class="fas fa-list-ul"></i></span>
                            </div>
                            <input type="text" name="tipo" class="form-control border-left-0" placeholder="e.g. Óptico, Análisis Espectral" required>
                        </div>
                    </div>

                    <div class="form-group mb-5">
                         <label class="form-label text-dark small font-weight-bold text-uppercase">Asignar a Experimentos (Opcional)</label>
                         <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 text-primary"><i class="fas fa-flask"></i></span>
                            </div>
                            <select name="experimentos[]" class="form-control custom-select border-left-0" multiple style="min-height: 120px;">
                                @foreach($experimentos as $experimento)
                                    <option value="{{ $experimento->id }}">{{ $experimento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <small class="form-text text-muted mt-2"><i class="fas fa-info-circle mr-1"></i> Si selecciona experimentos, el estado se establecerá automáticamente en <strong>"En Uso"</strong>. De lo contrario, será <strong>"Disponible"</strong>.</small>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('equipos.index') }}" class="btn btn-outline-secondary font-weight-bold px-4">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm px-5 font-weight-bold">Guardar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
