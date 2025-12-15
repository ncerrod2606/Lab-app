<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function index(): View {
        return view('dashboard');
    }

    function inyection(Request $request) {
        $valor = $request->valor; 
        
        $proyectos1 = Proyecto::where('id', '=', $valor)->orderBy('id', 'asc')->get();
    
        $proyectosDB1 = DB::select('select * from proyectos where id = :id order by id asc', ['id' => $valor]);
    
        $proyectosDB2 = DB::select('select * from proyectos where id = ' . $valor . ' order by id asc');
        
        $sql = 'select * from proyectos where id = :id order by id asc';
        $pdo = DB::connection()->getPdo();
        $sentence = $pdo->prepare($sql);
        $sentence->bindValue('id', $valor);
        $sentence->execute();
        $proyectosPDO1 = [];
        foreach($sentence as $row) {
            $proyectosPDO1[] = $row;
        }
        
        $sql = 'select * from proyectos where id = ' . $valor . ' order by id asc';
        $pdo = DB::connection()->getPdo();
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $proyectosPDO2 = [];
        foreach($sentence as $row) {
            $proyectosPDO2[] = $row;
        }
        
        dd($proyectos1, $proyectosDB1, $proyectosDB2, $proyectosPDO1, $proyectosPDO2, $valor);
    }

    function sql(Request $request) {
        $inicio = microtime(true);
        $proyectos1 = Proyecto::all();
        $proyectos2 = Proyecto::orderBy('titulo', 'desc')->get();
        $proyectos3 = Proyecto::where('id', 1)->orderBy('id', 'asc')->get();
        $proyectos4 = Proyecto::where('id', '>', 1)->orderBy('id', 'asc')->get();
        $fin = microtime(true);
        $tiempo = $fin - $inicio;
        
        $inicio = microtime(true);
        $proyectosDB1 = DB::select('select * from proyectos');
        $proyectosDB2 = DB::select('select * from proyectos order by titulo desc');
        $proyectosDB3 = DB::select('select * from proyectos where id = 1 order by id asc');
        $proyectosDB4 = DB::select('select * from proyectos where id > 1 order by id asc');
        $fin = microtime(true);
        $tiempo2 = $fin - $inicio;
        
        $inicio = microtime(true);
        $pdo = DB::connection()->getPdo();
        
        $sql = 'select * from proyectos';
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $proyectosPDO1 = [];
        foreach($sentence as $row) {
            $proyectosPDO1[] = $row;
        }
        
        $sql = 'select * from proyectos order by titulo desc';
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $proyectosPDO2 = [];
        foreach($sentence as $row) {
            $proyectosPDO2[] = $row;
        }
        
        $sql = 'select * from proyectos where id = 1 order by id asc';
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $proyectosPDO3 = [];
        foreach($sentence as $row) {
            $proyectosPDO3[] = $row;
        }
        
        $sql = 'select * from proyectos where id > 1 order by id asc';
        $sentence = $pdo->prepare($sql);
        $sentence->execute();
        $proyectosPDO4 = [];
        foreach($sentence as $row) {
            $proyectosPDO4[] = $row;
        }
        $fin = microtime(true);
        $tiempo3 = $fin - $inicio;
        
        dd($proyectos1, $proyectos2, $proyectos3, $proyectos4, 
            $proyectosDB1, $proyectosDB2, $proyectosDB3, $proyectosDB4,
            $proyectosPDO1, $proyectosPDO2, $proyectosPDO3, $proyectosPDO4,
            $tiempo, $tiempo2, $tiempo3);
    }
}
