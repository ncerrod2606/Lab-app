<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Investigador;
use Illuminate\Http\Request;
use App\Models\Equipo;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with('investigadores')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        $investigadores = Investigador::all();
        $equipos = Equipo::all();
        return view('proyectos.create', compact('investigadores', 'equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
        ]);

        $proyecto = Proyecto::create($request->all());

        if ($request->has('investigadores')) {
            $proyecto->investigadores()->sync($request->investigadores);
        }

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente.');
    }

    public function show(Proyecto $proyecto)
    {
        return view('proyectos.show', compact('proyecto'));
    }

    public function edit(Proyecto $proyecto)
    {
        $investigadores = Investigador::all();
        $equipos = Equipo::all();
        return view('proyectos.edit', compact('proyecto', 'investigadores', 'equipos'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
         $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
        ]);

        $proyecto->update($request->except(['investigadores', 'equipos']));

        if ($request->has('investigadores')) {
            $proyecto->investigadores()->sync($request->investigadores);
        } else {
            $proyecto->investigadores()->detach();
        }

        

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado.');
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado.');
    }
}