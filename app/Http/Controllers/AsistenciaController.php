<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Centro;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $centros = Centro::all();
        $centro_id = $request->centro_id;
        
        // Si el usuario no elige una fecha en el filtro, usamos la de hoy por defecto
        $fecha_seleccionada = $request->fecha ?? date('Y-m-d');
        
        // 1. Traer los estudiantes (filtrados por centro si es necesario)
        $estudiantes = Estudiante::when($centro_id, function($query) use ($centro_id) {
            return $query->where('centro_id', $centro_id);
        })->get();

        // 2. MAGIA AQUÍ: Buscamos en la base de datos si ya hay asistencia guardada en esa fecha
        $asistenciasGuardadas = Asistencia::where('fecha', $fecha_seleccionada)->get()->keyBy('estudiante_id');

        return view('asistencia', compact('estudiantes', 'centros', 'centro_id', 'fecha_seleccionada', 'asistenciasGuardadas'));
    }

    public function store(Request $request)
    {
        $fecha = $request->fecha;

        if($request->has('asistencia')) {
            foreach($request->asistencia as $estudiante_id => $estado) {
                // Actualiza si ya existe, o crea uno nuevo si no existía
                Asistencia::updateOrCreate(
                    ['estudiante_id' => $estudiante_id, 'fecha' => $fecha],
                    ['estado' => $estado]
                );
            }
        }

        return back()->with('success', 'Asistencia del ' . date('d/m/Y', strtotime($fecha)) . ' guardada correctamente en la Base de Datos.');
    }
}