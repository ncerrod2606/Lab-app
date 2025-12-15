<?php

namespace App\Http\Controllers;

use App\Models\Investigador;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImagenController extends Controller {
    
    function imagen($id): BinaryFileResponse {
        $investigador = Investigador::find($id);
        
        $privatePath = storage_path('app/private');
        $fallbackPath = public_path('assets/img/noimage.jpg');
        
        if($investigador == null ||
                $investigador->imagen == null ||
                !file_exists($privatePath . '/' . $investigador->imagen)) {
            
            if(file_exists($fallbackPath)) {
                return response()->file($fallbackPath);
            }
            abort(404); 
        }
        
        return response()->file($privatePath . '/' . $investigador->imagen);
    }
}
