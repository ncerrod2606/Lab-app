<?php

namespace App\Http\Controllers;

use App\Models\Experimento;
use App\Models\Proyecto;
use App\Models\Equipo;
use Illuminate\Http\Request;

class ExperimentoController extends Controller
{
    public function index()
    {
        $experimentos = Experimento::with(['proyecto', 'equipo'])->get();
        return view('experimentos.index', compact('experimentos'));
    }

    public function create()
    {
        $proyectos = Proyecto::all();
        $equipos = Equipo::where('estado', 'disponible')->get();
        return view('experimentos.create', compact('proyectos', 'equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'nombre' => 'required',
            'fecha' => 'required|date',
        ]);

        $experimento = Experimento::create($request->all());

        if ($request->has('equipos')) {
            $experimento->equipos()->sync($request->equipos);
            Equipo::whereIn('id', $request->equipos)->update(['estado' => 'en_uso']);
        }

        return redirect()->route('experimentos.index')->with('success', 'Experimento registrado.');
    }

    public function show(Experimento $experimento)
    {
        return view('experimentos.show', compact('experimento'));
    }

    public function edit(Experimento $experimento)
    {
        $proyectos = Proyecto::all();
        $equipos = Equipo::all();
        return view('experimentos.edit', compact('experimento', 'proyectos', 'equipos'));
    }

    public function update(Request $request, Experimento $experimento)
    {
         $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'nombre' => 'required',
            'fecha' => 'required|date',
        ]);

        $experimento->update($request->except('equipos'));

        if ($request->has('equipos')) {
            $changes = $experimento->equipos()->sync($request->equipos);
            
            Equipo::whereIn('id', $request->equipos)->update(['estado' => 'en_uso']);

            if (!empty($changes['detached'])) {
                foreach ($changes['detached'] as $equipoId) {
                   $equipo = Equipo::find($equipoId);
                   if ($equipo && $equipo->experimentos()->count() == 0) {
                       $equipo->update(['estado' => 'disponible']);
                   }
                }
            }
        } else {

             $detachedIds = $experimento->equipos()->pluck('equipos.id')->toArray();
             $experimento->equipos()->detach();
             
             foreach ($detachedIds as $equipoId) {
                $equipo = Equipo::find($equipoId);
                if ($equipo && $equipo->experimentos()->count() == 0) {
                    $equipo->update(['estado' => 'disponible']);
                }
             }
        }

        return redirect()->route('experimentos.index')->with('success', 'Experimento actualizado.');
    }

    public function destroy(Experimento $experimento)
    {
        $equipos = $experimento->equipos; 
        $experimento->delete();
        
        foreach ($equipos as $equipo) {
            if ($equipo->experimentos()->count() == 0) {
                $equipo->update(['estado' => 'disponible']);
            }
        }

        return redirect()->route('experimentos.index')->with('success', 'Experimento eliminado.');
    }
}
