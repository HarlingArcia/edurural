<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_completo', 'especialidad', 'centro_id'];

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}