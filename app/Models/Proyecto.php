<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = ['titulo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'estado'];

    public function investigadores()
    {
        return $this->belongsToMany(Investigador::class, 'investigador_proyecto');
    }

    public function experimentos()
    {
        return $this->hasMany(Experimento::class);
    }


}
