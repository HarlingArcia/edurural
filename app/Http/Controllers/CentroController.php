<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centro;

class CentroController extends Controller
{
    public function index()
    {
        // Trae todos los centros de la base de datos
        $centros = Centro::all();
        return view('centros', compact('centros'));
    }

    public function store(Request $request)
    {
        // Crea el nuevo centro en la base de datos
        Centro::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'maestros' => $request->maestros,
            'estado' => $request->estado
        ]);

        return redirect()->route('centros.index')->with('success', '¡Centro educativo agregado con éxito!');
    }

    public function destroy($id)
    {
        // Elimina el centro seleccionado
        Centro::findOrFail($id)->delete();
        return redirect()->route('centros.index')->with('error', 'El centro ha sido eliminado de la red.');
    }
}