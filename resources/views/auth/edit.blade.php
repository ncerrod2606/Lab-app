@extends('layouts.scientific')

@section('title', 'Configuración de Perfil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Actualizar Información Personal
            </div>
            <div class="card-body">
                @if (session('general'))
                    <div class="alert alert-{{ session('general') == 'Ok' ? 'success' : 'danger' }}">
                        {{ session('general') == 'Ok' ? 'Perfil actualizado correctamente.' : 'Hubo un error al actualizar el perfil.' }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr style="border-top: 1px solid var(--border-color); margin: 30px 0;">
                    <h4 style="margin-bottom: 20px; color: var(--text-primary); font-size: 1.1rem;">Cambiar Contraseña (Opcional)</h4>

                    <div class="form-group">
                        <label for="currentpassword" class="form-label">Contraseña Actual</label>
                        <input id="currentpassword" type="password" class="form-control @error('currentpassword') is-invalid @enderror" name="currentpassword" autocomplete="current-password">
                        <small class="text-muted">Necesaria para cambiar clave o email.</small>
                        @error('currentpassword')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
