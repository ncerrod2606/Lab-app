@extends('layouts.scientific')

@section('title', 'Editar Experimento')

@section('content')
    <div class="card">
        <div class="card-header">
            Detalles del Experimento
        </div>
        <form action="{{ route('experimentos.update', $experimento) }}" method="POST">
            @csrf
            @method('PUT')
             <div class="form-group">
                <label class="form-label">Nombre del Experimento</label>
                <input type="text" name="nombre" class="form-control" value="{{ $experimento->nombre }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Proyecto Asociado</label>
                <select name="proyecto_id" class="form-control" required>
                    @foreach($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}" {{ $experimento->proyecto_id == $proyecto->id ? 'selected' : '' }}>{{ $proyecto->titulo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Equipo Utilizado (Ctrl+Click para múltiple)</label>
                <select name="equipos[]" class="form-control" multiple style="height: 150px;">
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}"
                            {{ $experimento->equipos->contains($equipo->id) ? 'selected' : '' }}>
                            {{ $equipo->nombre }} ({{ $equipo->estado }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" value="{{ $experimento->fecha }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Objetivo</label>
                 <textarea name="objetivo" class="form-control" rows="3">{{ $experimento->objetivo }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Resultados</label>
                 <textarea name="resultados" class="form-control" rows="3">{{ $experimento->resultados }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('experimentos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
