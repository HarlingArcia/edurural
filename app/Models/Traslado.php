<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudiante_id', 'centro_origen_id', 'centro_destino_id', 
        'fecha_traslado', 'motivo', 'sexo', 'edad_estudiante', 
        'grado_estudiante', 'nombre_tutor', 'cedula_tutor'
    ];

    public function estudiante() { return $this->belongsTo(Estudiante::class); }
    public function origen() { return $this->belongsTo(Centro::class, 'centro_origen_id'); }
    public function destino() { return $this->belongsTo(Centro::class, 'centro_destino_id'); }
}