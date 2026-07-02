<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    // Se agregó 'grado' a la lista
    protected $fillable = ['nombre_completo', 'especialidad', 'grado', 'centro_id'];

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}