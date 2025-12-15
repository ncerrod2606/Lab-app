@extends('layouts.scientific')

@section('title', 'Nueva Nota')

@section('content')
    <div class="card">
        <div class="card-header">
            Agregar Observación
        </div>
        <form action="{{ route('notas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Experimento Relacionado</label>
                <select name="experimento_id" class="form-control" required>
                    <option value="">Seleccione...</option>
                    @foreach($experimentos as $experimento)
                        <option value="{{ $experimento->id }}">{{ $experimento->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Contenido de la Nota</label>
                <textarea name="contenido" class="form-control" rows="6" placeholder="Detalles de la observación, anomalías, resultados parciales..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Nota</button>
            <a href="{{ route('notas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
