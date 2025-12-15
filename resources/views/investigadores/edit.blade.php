@extends('layouts.scientific')

@section('title', 'Editar Investigador')

@section('content')
    <div class="card">
        <div class="card-header">
            Editar Datos
        </div>
        <form action="{{ route('investigadores.update', $investigador) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Foto de Perfil</label>
                @if($investigador->imagen)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ route('imagen', $investigador->id) }}?v={{ $investigador->updated_at->timestamp }}" alt="Perfil" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>
                @endif
                <input type="file" name="imagen" class="form-control" accept="image/*">
                <small class="text-muted">Deja esto vacío si no quieres cambiar la imagen.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Nombre Completo</label>
                <input type="text" name="nombre" class="form-control" value="{{ $investigador->nombre }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Especialidad</label>
                <input type="text" name="especialidad" class="form-control" value="{{ $investigador->especialidad }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $investigador->email }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Biografía</label>
                <textarea name="biografia" class="form-control" rows="4">{{ $investigador->biografia }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('investigadores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
