@extends('layouts.scientific')

@section('title', 'Notas de Investigación')

@section('content')
@section('content')
<div class="row mb-5">
    <div class="col-12 mb-4 d-flex justify-content-between align-items-center animate-fade-up">
        <h2 class="font-weight-800 text-dark mb-0">Notas de Campo</h2>
        <a href="{{ route('notas.create') }}" class="btn btn-primary shadow-lg"><i class="fas fa-sticky-note mr-2"></i>Nueva Nota</a>
    </div>

    <!-- Cards View -->
    <div class="col-12 mb-5">
        <h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-100"><i class="fas fa-th-large mr-2"></i>Vista de Tarjetas</h5>
        <div class="row">
            @forelse($notas as $index => $nota)
            <div class="col-md-6 col-lg-4 mb-4 animate-fade-up" style="animation-delay: {{ $index * 0.1 + 0.2 }}s;">
                <div class="glass-card h-100 p-4 d-flex flex-column position-relative shadow-sm" 
                     style="background-color: #fffde7; border-left: 5px solid #fdd835; transition: transform 0.3s ease;">
                    
                    <div class="d-flex justify-content-between align-items-start mb-3">
                         <span class="badge badge-warning text-dark border border-warning px-2 py-1" style="opacity: 0.8; font-size: 0.7rem;">NOTA #{{ $nota->id }}</span>
                         <small class="text-muted font-weight-bold"><i class="far fa-clock mr-1"></i> {{ $nota->created_at->format('d M, H:i') }}</small>
                    </div>
                    
                    <h6 class="font-weight-bold text-dark mb-2">
                        <a href="{{ route('experimentos.show', $nota->experimento) }}" class="text-dark text-decoration-none hover-link">{{ Str::limit($nota->experimento->nombre, 40) }}</a>
                    </h6>
                    
                    <p class="text-dark mb-4 flex-grow-1" style="font-family: 'Courier New', monospace; font-size: 0.9rem; line-height: 1.5;">
                        {{ Str::limit($nota->contenido, 120) }}
                    </p>

                    <div class="mt-auto border-top border-warning pt-3 d-flex justify-content-between align-items-center" style="border-top-color: rgba(0,0,0,0.05) !important;">
                        <a href="{{ route('notas.show', $nota) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3 font-weight-bold stretched-link" style="font-size: 0.8rem;">Leer más</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 animate-fade-up delay-200">
                 <div class="alert alert-light border-0 shadow-sm text-center py-4">
                    <i class="fas fa-pencil-alt fa-2x text-muted mb-2"></i>
                    <p class="mb-0 text-muted">No hay notas registradas.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<h5 class="text-uppercase text-secondary font-weight-bold mb-3 letter-spacing-1 animate-fade-up delay-300"><i class="fas fa-list mr-2"></i>Vista de Lista</h5>
<!-- List View (Original) -->
<div class="card animate-fade-up delay-300">
        <div class="card-header">
            <span>Registro de Obsvervaciones</span>
            <a href="{{ route('notas.create') }}" class="btn btn-primary">Nueva Nota</a>
        </div>
        <div class="notes-list">
            @foreach($notas as $nota)
            <div class="card" style="border-left: 5px solid var(--primary-color);">
                <strong>Experimento: {{ $nota->experimento->nombre }}</strong>
                <p style="white-space: pre-wrap; margin: 10px 0;">{{ $nota->contenido }}</p>
                <small style="color: #757575;">Registrado el: {{ $nota->created_at->format('d/m/Y H:i') }}</small>
                <div class="text-right mt-3 d-flex justify-content-end gap-2">
                     <a href="{{ route('notas.show', $nota) }}" class="btn btn-info btn-sm text-white font-weight-bold shadow-sm">Ver</a>
                     <a href="{{ route('notas.edit', $nota) }}" class="btn btn-primary btn-sm font-weight-bold shadow-sm">Editar</a>
                     <form action="{{ route('notas.destroy', $nota) }}" method="POST" class="delete-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm font-weight-bold shadow-sm">Borrar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
