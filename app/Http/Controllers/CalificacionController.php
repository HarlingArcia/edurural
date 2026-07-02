<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Centro;
use App\Models\Calificacion;

class CalificacionController extends Controller
{
    // Función helper para obtener materias por grado
    public static function getMaterias($grado) {
        $grado = strtolower($grado);
        
        if (str_contains($grado, 'preescolar')) {
            return ['Lenguaje y Comunicación', 'Pensamiento Matemático', 'Exploración y Comprensión del Mundo', 'Educación Socioemocional', 'Artes', 'Desarrollo'];
        } 
        elseif (str_contains($grado, 'primaria')) {
            return ['Lengua y Literatura', 'Matemáticas', 'Ciencias Naturales', 'Estudios Sociales', 'Creciendo en Valores', 'Educación Física', 'AEP', 'Taller de Arte y Cultura'];
        } 
        elseif (str_contains($grado, 'secundaria')) {
            return ['Matemáticas', 'Lengua y Literatura', 'Ciencias Sociales', 'Historia', 'Geografía', 'Ciencias Naturales', 'Inglés', 'Educación Física', 'Creciendo en Valores', 'Derecho y Dignidad a la Mujer', 'Talleres Arte y Cultura Tecnológica', 'Física', 'Química', 'Biología'];
        }
        return [];
    }

    public function index(Request $request) {
        $centros = Centro::all();
        $centro_id = $request->centro_id;
        $estudiantes = Estudiante::when($centro_id, fn($q) => $q->where('centro_id', $centro_id))->get();
        return view('calificaciones', compact('estudiantes', 'centros', 'centro_id'));
    }
}