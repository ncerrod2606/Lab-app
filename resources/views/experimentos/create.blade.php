@extends('layouts.scientific')

@section('title', 'Nuevo Experimento')

@section('content')
    <div class="card">
        <div class="card-header">
            Configuración del Experimento
        </div>
        <form action="{{ route('experimentos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nombre del Experimento</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Proyecto Asociado</label>
                <select name="proyecto_id" class="form-control" required>
                    <option value="">Seleccione un proyecto...</option>
                    @foreach($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}">{{ $proyecto->titulo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Equipo Utilizado (Ctrl+Click para múltiple)</label>
                <select name="equipos[]" class="form-control" multiple style="height: 150px;">
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }} ({{ $equipo->estado }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Objetivo</label>
                 <textarea name="objetivo" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Resultados Preliminares</label>
                 <textarea name="resultados" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="{{ route('experimentos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
