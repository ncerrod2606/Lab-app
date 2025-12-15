<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigador extends Model
{
    use HasFactory;

    protected $table = 'investigadores';

    protected $fillable = ['nombre', 'especialidad', 'email', 'biografia', 'imagen'];

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'investigador_proyecto');
    }
}
