<?php

namespace App\Http\Controllers;

use App\Models\NotaInvestigacion;
use App\Models\Experimento;
use Illuminate\Http\Request;

class NotaInvestigacionController extends Controller
{
    public function index()
    {
        $notas = NotaInvestigacion::with('experimento')->latest()->get();
        return view('notas.index', compact('notas'));
    }

    public function create()
    {
        $experimentos = Experimento::all();
        return view('notas.create', compact('experimentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'experimento_id' => 'required|exists:experimentos,id',
            'contenido' => 'required',
        ]);

        NotaInvestigacion::create($request->all());

        return redirect()->route('notas.index')->with('success', 'Nota registrada.');
    }

    public function edit(NotaInvestigacion $nota)
    {
        $experimentos = Experimento::all();
        return view('notas.edit', compact('nota', 'experimentos'));
    }

    public function update(Request $request, NotaInvestigacion $nota)
    {
         $request->validate([
            'experimento_id' => 'required|exists:experimentos,id',
            'contenido' => 'required',
        ]);

        $nota->update($request->all());

        return redirect()->route('notas.index')->with('success', 'Nota actualizada.');
    }

    public function destroy(NotaInvestigacion $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Nota eliminada.');
    }

    public function show(NotaInvestigacion $nota)
    {
        return view('notas.show', compact('nota'));
    }
}
