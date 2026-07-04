<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo', 'cedula', 'edad', 'telefono', 'lugar', 
        'gmail', 'especialidad', 'grado', 'experiencia_laboral', 'centro_id'
    ];

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}