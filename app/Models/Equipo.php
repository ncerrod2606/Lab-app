<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = ['nombre', 'tipo', 'estado', 'investigador_id'];

    public function experimentos()
    {
        return $this->belongsToMany(Experimento::class, 'equipo_experimento');
    }

    public function investigador()
    {
        return $this->belongsTo(Investigador::class);
    }


}
