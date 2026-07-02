<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Centro;

class EstudianteController extends Controller
{
    // 1. FUNCIÓN INDEX (Esta es la que faltaba y carga la pantalla)
    public function index()
    {
        $estudiantes = Estudiante::with('centro')->get();
        $centros = Centro::all();
        return view('estudiantes', compact('estudiantes', 'centros'));
    }

    // 2. FUNCIÓN STORE (La que guarda con las reglas estrictas y mayúsculas)
    public function store(Request $request)
    {
        // Limpieza de datos (Normalización)
        $codigo_limpio = strtoupper(trim($request->codigo_mined));
        $codigo_limpio = str_replace(' ', '-', $codigo_limpio); 
        $codigo_limpio = preg_replace('/-+/', '-', $codigo_limpio);

        $request->merge([
            'codigo_mined' => $codigo_limpio
        ]);

        // Validación estricta
        $request->validate([
            'codigo_mined' => 'required|unique:estudiantes,codigo_mined',
            'nombre_completo' => 'required',
            'edad' => 'required|numeric',
            'grado' => 'required',
        ], [
            'codigo_mined.unique' => 'El Código MINED (' . $codigo_limpio . ') ya pertenece a otro estudiante. Verifique el dato.',
        ]);

        // Validar Reglas de Red (Secundaria vs Primaria)
        $centro = Centro::findOrFail($request->centro_id);
        $gradoIngresado = strtolower($request->grado);

        if (str_contains($gradoIngresado, 'secundaria') && $centro->codigo !== 'C-01') {
            return back()
                ->withInput()
                ->with('error', 'Regla de Red: Solo el Centro Base Fidel Castro Ruiz imparte la modalidad de Secundaria.');
        }

        if (str_contains($gradoIngresado, 'primaria') && $centro->codigo === 'C-01') {
            return back()
                ->withInput()
                ->with('error', 'Regla de Red: El Centro Base Fidel Castro Ruiz es exclusivo para Secundaria.');
        }

        // Guardar en la base de datos
        Estudiante::create($request->all());
        
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante matriculado con éxito');
    }

    // 3. FUNCIÓN DESTROY (La que elimina estudiantes)
    public function destroy($id)
    {
        Estudiante::findOrFail($id)->delete();
        return redirect()->route('estudiantes.index')->with('error', 'Estudiante dado de baja');
    }
}