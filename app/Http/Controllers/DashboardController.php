<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Centro;
use App\Models\Docente; // Importar el modelo Docente

class DashboardController extends Controller
{
    public function index()
    {
        $totalEstudiantes = Estudiante::count();
        $totalCentros = Centro::count();
        $totalDocentes = Docente::count(); // Ahora cuenta los registros de la tabla docentes
        
        return view('inicio', compact('totalEstudiantes', 'totalDocentes', 'totalCentros'));
    }
}