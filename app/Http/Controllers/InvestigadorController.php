<?php

namespace App\Http\Controllers;

use App\Models\Investigador;
use Illuminate\Http\Request;

class InvestigadorController extends Controller
{
    public function index()
    {
        $investigadores = Investigador::all();
        return view('investigadores.index', compact('investigadores'));
    }

    public function create()
    {
        return view('investigadores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:investigadores',
            'especialidad' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,jfif,png,jpg,gif|max:2048'
        ]);

        $investigador = new Investigador($request->all());
        $result = false;
        $txtmessage = '';

        try {
            $result = $investigador->save();
            $txtmessage = 'Investigador registrado correctamente.';
            
            if($request->hasFile('imagen')) {
                $ruta = $this->upload($request, $investigador);
                $investigador->imagen = $ruta;
                $investigador->save();
            }
        } catch(\Illuminate\Database\UniqueConstraintViolationException $e) {
            $txtmessage = 'Error: El email ya está registrado.';
            $result = false;
        } catch(\Illuminate\Database\QueryException $e) {
            $txtmessage = 'Error en la base de datos: Campos obligatorios faltantes.';
            $result = false;
        } catch(\Exception $e) {
            $txtmessage = 'Error fatal al guardar.';
            $result = false;
        }

        if($result) {
            return redirect()->route('investigadores.index')->with('success', $txtmessage);
        } else {
            return back()->withInput()->withErrors(['message' => $txtmessage]);
        }
    }

    public function show(Investigador $investigador)
    {
        return view('investigadores.show', compact('investigador'));
    }

    public function edit(Investigador $investigador)
    {
        return view('investigadores.edit', compact('investigador'));
    }

    public function update(Request $request, Investigador $investigador)
    {
         $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:investigadores,email,' . $investigador->id,
            'especialidad' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,jfif,png,jpg,gif|max:2048'
        ]);

        $result = false;
        $txtmessage = '';

        try {
            if($request->deleteImage == 'true') {
                 if($investigador->imagen && file_exists(storage_path('app/private/' . $investigador->imagen))) {
                    unlink(storage_path('app/private/' . $investigador->imagen));
                }
                $investigador->imagen = null;
            }

            $investigador->fill($request->except('imagen'));
            
            if($request->hasFile('imagen')) {
                 if($investigador->imagen && file_exists(storage_path('app/private/' . $investigador->imagen))) {
                    unlink(storage_path('app/private/' . $investigador->imagen));
                }
                $ruta = $this->upload($request, $investigador);
                $investigador->imagen = $ruta;
            }

            $result = $investigador->save();
            $txtmessage = 'Investigador actualizado correctamente.';

        } catch(\Illuminate\Database\UniqueConstraintViolationException $e) {
            $txtmessage = 'Error: El email ya existe.';
            $result = false;
        } catch(\Illuminate\Database\QueryException $e) {
            $txtmessage = 'Error con datos nulos o inválidos.';
            $result = false;
        } catch(\Exception $e) {
            $txtmessage = 'Error fatal al actualizar.';
            $result = false;
        }

        if($result) {
            return redirect()->route('investigadores.index')->with('success', $txtmessage);
        } else {
            return back()->withInput()->withErrors(['message' => $txtmessage]);
        }
    }

    public function destroy(Investigador $investigador)
    {
        $result = false;
        $txtmessage = '';
        
        try {
            if($investigador->imagen && file_exists(storage_path('app/private/' . $investigador->imagen))) {
                unlink(storage_path('app/private/' . $investigador->imagen));
            }
            $result = $investigador->delete();
            $txtmessage = 'Investigador eliminado.';
        } catch(\Exception $e) {
            $txtmessage = 'No se pudo eliminar al investigador.';
            $result = false;
        }

        if($result) {
            return redirect()->route('investigadores.index')->with('success', $txtmessage);
        } else {
            return back()->withErrors(['message' => $txtmessage]);
        }
    }

    private function upload(Request $request, Investigador $investigador): string {
        $image = $request->file('imagen');
        $name = $investigador->id . '.' . $image->getClientOriginalExtension();
        $image->move(storage_path('app/private'), $name);
        
        return $name; 
    }
}
