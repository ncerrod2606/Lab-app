<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaInvestigacion extends Model
{
    use HasFactory;

    protected $table = 'notas_investigacion';

    protected $fillable = ['experimento_id', 'contenido', 'fecha_creacion'];

    public function experimento()
    {
        return $this->belongsTo(Experimento::class);
    }
}
