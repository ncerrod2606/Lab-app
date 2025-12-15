<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experimento extends Model
{
    use HasFactory;

    protected $table = 'experimentos';

    protected $fillable = ['proyecto_id', 'equipo_id', 'nombre', 'fecha', 'objetivo', 'resultados'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_experimento');
    }

    public function notas()
    {
        return $this->hasMany(NotaInvestigacion::class);
    }
}
