<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Centro;
use App\Models\Calificacion;

class CalificacionController extends Controller
{
    // 1. Función para obtener las materias según el grado
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

    // 2. Función para mostrar la pantalla con el Buscador y el Filtro
    public function index(Request $request) 
    {
        $centros = Centro::all();
        $centro_id = $request->centro_id;
        $buscar = $request->buscar; // Capturamos lo que se escribe en el buscador

        // Normalizamos la búsqueda para el Código MINED (convierte a mayúsculas y quita espacios)
        $buscarNormalizado = null;
        if ($buscar) {
            $buscarNormalizado = strtoupper(trim($buscar));
            $buscarNormalizado = str_replace(' ', '-', $buscarNormalizado); 
            $buscarNormalizado = preg_replace('/-+/', '-', $buscarNormalizado); // Evita guiones dobles
        }

        $estudiantes = Estudiante::when($centro_id, function($query) use ($centro_id) {
                return $query->where('centro_id', $centro_id);
            })
            ->when($buscar, function($query) use ($buscar, $buscarNormalizado) {
                return $query->where(function($q) use ($buscar, $buscarNormalizado) {
                    // Busca el texto tal cual lo escribiste para los Nombres (ej. "Ana")
                    $q->where('nombre_completo', 'LIKE', '%' . $buscar . '%')
                      // Busca la versión "limpia" exclusivamente para el Código MINED (ej. "MIN-1001")
                      ->orWhere('codigo_mined', 'LIKE', '%' . $buscarNormalizado . '%');
                });
            })
            ->get();

        return view('calificaciones', compact('estudiantes', 'centros', 'centro_id', 'buscar'));
    }

    // 3. Función para guardar las calificaciones
    public function store(Request $request)
    {
        $parcial = $request->parcial;

        if($request->has('notas')) {
            foreach($request->notas as $est_id => $materias) {
                Calificacion::updateOrCreate(
                    ['estudiante_id' => $est_id, 'parcial' => $parcial],
                    $materias
                );
            }
        }

        return back()->with('success', 'Calificaciones del Parcial ' . $parcial . ' registradas.');
    }
}