@extends('layouts.scientific')

@section('title', 'Nuevo Investigador')

@section('content')
    <div class="card">
        <div class="card-header">
            Formulario de Registro
        </div>
        <form action="{{ route('investigadores.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Foto de Perfil</label>
                <input type="file" name="imagen" class="form-control" accept="image/*">
            </div>

            <div class="form-group">
                <label class="form-label">Nombre Completo</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Especialidad (e.g., Biología, Física)</label>
                <input type="text" name="especialidad" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email Institucional</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Biografía / Notas</label>
                <textarea name="biografia" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Investigador</button>
            <a href="{{ route('investigadores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
