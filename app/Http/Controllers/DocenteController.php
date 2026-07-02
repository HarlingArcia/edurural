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
       
        $request->validate([
            'nombre_completo' => 'required',
            'grado' => 'required', // Ahora el grado es obligatorio
            'centro_id' => 'required'
        ]);

        $centro = Centro::findOrFail($request->centro_id);
        
        // Convertimos el grado a minúsculas para compararlo
        $gradoIngresado = strtolower($request->grado);

    
        if ((str_contains($gradoIngresado, 'secundaria') || str_contains($gradoIngresado, 'año')) && $centro->codigo !== 'C-01') {
            return back()
                ->withInput()
                ->with('error', 'Bloqueo del Sistema: Solo el Centro Base Fidel Castro Ruiz permite asignar maestros para Secundaria (1er a 3er año).');
        }

        if ((str_contains($gradoIngresado, 'primaria') || str_contains($gradoIngresado, 'grado')) && $centro->codigo === 'C-01') {
            return back()
                ->withInput()
                ->with('error', 'Bloqueo del Sistema: El Centro Base Fidel Castro Ruiz es exclusivo para maestros de Secundaria.');
        }

        Docente::create($request->all());
        
        return back()->with('success', 'Maestro registrado y asignado al centro exitosamente.');
    }

    public function destroy($id)
    {
        Docente::findOrFail($id)->delete();
        return back()->with('error', 'Maestro dado de baja del sistema.');
    }
}