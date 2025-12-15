<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Experimento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all();
        $experimentos = Experimento::all();
        return view('equipos.index', compact('equipos', 'experimentos'));
    }

    public function create()
    {
        $experimentos = Experimento::all();
        return view('equipos.create', compact('experimentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'experimentos' => 'nullable|array',
            'experimentos.*' => 'exists:experimentos,id',
        ]);

        $data = $request->except('experimentos');
        $data['estado'] = $request->has('experimentos') && !empty($request->experimentos) ? 'en_uso' : 'disponible';
        
        $equipo = Equipo::create($data);

        if ($request->has('experimentos')) {
            $equipo->experimentos()->attach($request->experimentos);
        }

        return redirect()->route('equipos.index')->with('success', 'Equipo registrado.');
    }

    public function show(Equipo $equipo)
    {
        return view('equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo): View
    {
        $experimentos = Experimento::all();
        return view('equipos.edit', compact('equipo', 'experimentos'));
    }

    public function update(Request $request, Equipo $equipo): RedirectResponse
    {
        $rules = [
            'nombre'           => 'required|max:255',
            'tipo'             => 'required|max:255',
            'estado_operativo' => 'required|in:operativo,mantenimiento',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
             return back()->withInput()->withErrors($validator);
        }

        try {
            $equipo->update($request->only(['nombre', 'tipo']));

            if ($request->estado_operativo === 'mantenimiento') {
                $equipo->experimentos()->detach();
                $equipo->update(['estado' => 'mantenimiento', 'investigador_id' => null]);
            } else {
                if ($request->has('experimentos')) {
                    $equipo->experimentos()->sync($request->experimentos);
                    $equipo->update(['estado' => 'en_uso']);
                } else {
                    $equipo->experimentos()->detach();
                    $equipo->update(['estado' => 'disponible']);
                }
            }
            
            $message = 'Equipo actualizado correctamente.';
            $result = true;
        } catch (\Exception $e) {
            $message = 'Error al actualizar el equipo: ' . $e->getMessage();
            $result = false;
        }

        if ($result) {
            return redirect()->route('equipos.index')->with('success', $message);
        } else {
            return back()->withInput()->withErrors(['general' => $message]);
        }
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado.');
    }

    public function asignar(Request $request, Equipo $equipo)
    {
        $request->validate([
            'experimento_ids' => 'required|array',
            'experimento_ids.*' => 'exists:experimentos,id'
        ]);

        $equipo->experimentos()->syncWithoutDetaching($request->experimento_ids);
        
        $equipo->update([
            'estado' => 'en_uso',
            'investigador_id' => null
        ]);

        return back()->with('success', 'Equipo asignado correctamente.');
    }

    public function liberar(Equipo $equipo)
    {
        $equipo->experimentos()->detach();

        $equipo->update([
            'estado' => 'disponible',
            'investigador_id' => null
        ]);

        return back()->with('success', 'Equipo liberado y disponible.');
    }
}
