@extends('layouts.scientific')

@section('title', 'Editar Nota')

@section('content')
    <div class="card">
        <div class="card-header">
            Modificar Observación
        </div>
        <form action="{{ route('notas.update', $nota) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Experimento Relacionado</label>
                <select name="experimento_id" class="form-control" required>
                    @foreach($experimentos as $experimento)
                        <option value="{{ $experimento->id }}" {{ $nota->experimento_id == $experimento->id ? 'selected' : '' }}>{{ $experimento->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Contenido de la Nota</label>
                <textarea name="contenido" class="form-control" rows="6" required>{{ $nota->contenido }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Nota</button>
            <a href="{{ route('notas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
