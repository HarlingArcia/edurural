<?php

namespace App\Http\Controllers;

use App\Models\Centro;

class ReporteController extends Controller
{
    public function index()
    {
        // Traemos los centros y contamos cuántos estudiantes tiene cada uno
        $centros = Centro::withCount('estudiantes')->get();
        return view('reportes', compact('centros'));
    }
}