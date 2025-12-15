@extends('layouts.scientific')

@section('title', 'Iniciar Nuevo Proyecto')

@section('content')
    <div class="card">
        <div class="card-header">
            Definición del Proyecto
        </div>
        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Título del Proyecto</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Descripción / Hipótesis</label>
                <textarea name="descripcion" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
             <div class="form-group">
                <label class="form-label">Estado Inicial</label>
                <select name="estado" class="form-control">
                    <option value="planificacion">Planificación</option>
                    <option value="en_progreso">En Progreso</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Asignar Investigadores (Ctrl+Click para múltiple)</label>
                <select name="investigadores[]" class="form-control" multiple style="height: 150px;">
                    @foreach($investigadores as $investigador)
                        <option value="{{ $investigador->id }}">{{ $investigador->nombre }} ({{ $investigador->especialidad }})</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Crear Proyecto</button>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
