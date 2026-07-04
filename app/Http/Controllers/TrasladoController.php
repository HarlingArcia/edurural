<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Traslado;
use App\Models\Estudiante;
use App\Models\Centro;

class TrasladoController extends Controller
{
    // 1. Función para mostrar la pantalla
    public function index()
    {
        $traslados = Traslado::with(['estudiante', 'origen', 'destino'])->orderBy('created_at', 'desc')->get();
        $estudiantes = Estudiante::with('centro')->get();
        $centros = Centro::all();
        
        return view('traslados', compact('traslados', 'estudiantes', 'centros'));
    }

    // 2. Función para guardar el traslado y aplicar las validaciones
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required',
            'centro_destino_id' => 'required',
            'fecha_traslado' => 'required|date',
            'motivo' => 'required',
            'sexo' => 'required',
            'nombre_tutor' => 'required',
            'cedula_tutor' => 'required|unique:traslados,cedula_tutor', // Bloquea cédulas repetidas
        ], [
            'cedula_tutor.unique' => 'Bloqueo: Esta cédula de madre/tutora ya se utilizó en otro traslado. No se permiten duplicados.'
        ]);

        $estudiante = Estudiante::findOrFail($request->estudiante_id);
        $centro_origen = $estudiante->centro_id;
        $centro_destino = $request->centro_destino_id;

        // Validación: No puede trasladarse a la misma escuela
        if ($centro_origen == $centro_destino) {
            return back()->with('error', 'El centro de destino no puede ser la escuela actual.');
        }

        // Crear el traslado con la nueva información
        Traslado::create([
            'estudiante_id' => $estudiante->id,
            'centro_origen_id' => $centro_origen,
            'centro_destino_id' => $centro_destino,
            'fecha_traslado' => $request->fecha_traslado,
            'motivo' => $request->motivo,
            'sexo' => $request->sexo,
            'edad_estudiante' => $request->edad_estudiante,
            'grado_estudiante' => $request->grado_estudiante,
            'nombre_tutor' => $request->nombre_tutor,
            'cedula_tutor' => $request->cedula_tutor,
        ]);

        // Cambiar al estudiante de escuela en la base de datos
        $estudiante->update(['centro_id' => $centro_destino]);

        return back()->with('success', 'Traslado Oficial registrado con éxito.');
    }
}