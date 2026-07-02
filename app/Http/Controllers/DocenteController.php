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
            'centro_id' => 'required'
        ]);

        Docente::create($request->all());
        
        return back()->with('success', 'Maestro registrado y asignado al centro exitosamente.');
    }

    public function destroy($id)
    {
        Docente::findOrFail($id)->delete();
        return back()->with('error', 'Maestro dado de baja del sistema.');
    }
}