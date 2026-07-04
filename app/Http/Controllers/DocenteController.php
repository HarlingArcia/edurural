<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Centro;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with('centro')->get();
        $centros = Centro::all();
        return view('docentes', compact('docentes', 'centros'));
    }

    public function store(Request $request)
    {
        // 1. Validar campos obligatorios y Cédula Única
        $request->validate([
            'nombre_completo' => 'required',
            'cedula' => 'required|unique:docentes,cedula', // La cédula no se puede repetir
            'centro_id' => 'required',
            'grado' => 'required'
        ], [
            'cedula.unique' => 'Error: Esta cédula ya está registrada en otro maestro.'
        ]);

        $centro = Centro::findOrFail($request->centro_id);
        
        // Convertimos el grado a minúsculas para comparar
        $gradoIngresado = strtolower($request->grado);

        // 2. REGLAS DE RED: Secundaria vs Primaria
        if ((str_contains($gradoIngresado, 'secundaria') || str_contains($gradoIngresado, 'año')) && $centro->codigo !== 'C-01') {
            return back()
                ->withInput() 
                ->with('error', 'Bloqueo: Solo el Centro Base Fidel Castro Ruiz permite maestros de Secundaria.');
        }

        if ((str_contains($gradoIngresado, 'primaria') || str_contains($gradoIngresado, 'grado')) && $centro->codigo === 'C-01') {
            return back()
                ->withInput()
                ->with('error', 'Bloqueo: El Centro Base Fidel Castro Ruiz es exclusivo para maestros de Secundaria.');
        }

        // 3. Guardar al profesor con todos los campos nuevos
        Docente::create($request->all());
        
        return back()->with('success', 'Maestro registrado y asignado exitosamente.');
    }

    public function destroy($id)
    {
        Docente::findOrFail($id)->delete();
        return back()->with('error', 'Maestro dado de baja del sistema.');
    }
}