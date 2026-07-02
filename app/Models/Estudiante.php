<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = ['codigo_mined', 'nombre_completo', 'edad', 'sexo', 'centro_id', 'grado', 'modalidad'];

    // Relación: Un estudiante pertenece a un centro
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}