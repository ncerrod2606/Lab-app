@extends('layouts.scientific')

@section('title', 'Editar Proyecto')

@section('content')
    <div class="card">
        <div class="card-header">
            Editar Detalles
        </div>
        <form action="{{ route('proyectos.update', $proyecto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Título del Proyecto</label>
                <input type="text" name="titulo" class="form-control" value="{{ $proyecto->titulo }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="5" required>{{ $proyecto->descripcion }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" value="{{ $proyecto->fecha_inicio }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Fecha de Fin (Estimada o Real)</label>
                <input type="date" name="fecha_fin" class="form-control" value="{{ $proyecto->fecha_fin }}">
            </div>
             <div class="form-group">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-control">
                    <option value="planificacion" {{ $proyecto->estado == 'planificacion' ? 'selected' : '' }}>Planificación</option>
                    <option value="en_progreso" {{ $proyecto->estado == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                    <option value="completado" {{ $proyecto->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                    <option value="cancelado" {{ $proyecto->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Asignar Investigadores (Ctrl+Click para múltiple)</label>
                <select name="investigadores[]" class="form-control" multiple style="height: 150px;">
                    @foreach($investigadores as $investigador)
                        <option value="{{ $investigador->id }}" 
                            {{ $proyecto->investigadores->contains($investigador->id) ? 'selected' : '' }}>
                            {{ $investigador->nombre }} ({{ $investigador->especialidad }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Proyecto</button>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
