@extends('layouts.scientific')

@section('title', 'Nota de Laboratorio')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Notebook Style Card -->
            <div class="card shadow-lg border-0" style="background-color: #fdfbf7; background-image: linear-gradient(#e1e1e1 1px, transparent 1px); background-size: 100% 2em; line-height: 2em;">
                <!-- Binding Holes Visualization (CSS tricks) -->
                <div style="position: absolute; left: 20px; top: 0; bottom: 0; width: 40px; border-right: 2px solid rgba(0,0,0,0.05);"></div>
                
                <div class="card-body p-5 ml-4">
                    <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-2" style="border-bottom-color: rgba(0,0,0,0.1) !important;">
                        <div>
                             <h6 class="text-danger font-weight-bold mb-0 text-uppercase" style="letter-spacing: 2px;">Confidencial</h6>
                             <small class="text-muted">Ref: NOTA-{{ $nota->id }}</small>
                        </div>
                        <div class="text-right">
                             <div class="text-dark font-weight-bold">{{ $nota->created_at->format('d/m/Y') }}</div>
                             <div class="text-muted small">{{ $nota->created_at->format('H:i A') }}</div>
                        </div>
                    </div>

                    <h4 class="mb-4 text-dark font-weight-bold">
                        Sobre: <a href="{{ route('experimentos.show', $nota->experimento) }}" class="text-dark text-decoration-none border-bottom border-dark">{{ $nota->experimento->nombre }}</a>
                    </h4>

                    <div class="note-content text-dark" style="font-family: 'Courier New', Courier, monospace; font-size: 1.1rem; min-height: 300px;">
                        {{ $nota->contenido }}
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 text-right pb-4 pr-5">
                     <span class="text-muted small d-block mb-3">Última edición: {{ $nota->updated_at->diffForHumans() }}</span>
                     <form action="{{ route('notas.destroy', $nota) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger btn-sm">Arrancar Hoja (Eliminar)</button>
                    </form>
                     <a href="{{ route('notas.edit', $nota) }}" class="btn btn-primary shadow-sm rounded-pill px-4 ml-2"><i class="fas fa-pen-fancy"></i> Editar</a>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('notas.index') }}" class="text-muted"><i class="fas fa-arrow-left"></i> Volver al cuaderno</a>
            </div>
        </div>
    </div>
</div>
@endsection
