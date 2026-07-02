<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\DocenteController;

Route::get('/', [DashboardController::class, 'index']);
Route::resource('estudiantes', EstudianteController::class);

Route::get('/asistencia', [AsistenciaController::class, 'index'])->name('asistencia.index');
Route::post('/asistencia', [AsistenciaController::class, 'store'])->name('asistencia.store');

Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');

Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');

Route::resource('centros', CentroController::class);

Route::resource('docentes', DocenteController::class);


Auth::routes();