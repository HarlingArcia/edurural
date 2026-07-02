<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = ['estudiante_id', 'fecha', 'estado'];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}