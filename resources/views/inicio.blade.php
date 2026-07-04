@extends('adminlte::page')
@section('title', 'Programa MINED - Inicio')

@section('content_header')
    <h1 class="text-dark font-weight-bold">Panel de Inicio Global</h1>
@stop

@section('content')
    <!-- BANNER DE BIENVENIDA -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-primary text-white shadow-sm" style="border-radius: 10px;">
                <div class="card-body p-4 text-center">
                    <h3 class="font-weight-bold mb-3"><i class="fas fa-graduation-cap"></i> ¡Bienvenido al Sistema de Gestión MINED!</h3>
                    <h5 class="font-italic" style="font-weight: 300;">
                        "La educación no cambia el mundo, cambia a las personas que van a cambiar el mundo."
                    </h5>
                    <p class="mt-2 mb-0 text-sm opacity-75">— Paulo Freire</p>
                </div>
            </div>
        </div>
    </div>

    <!-- PANELES DE ESTADÍSTICAS -->
    <div class="row">
        <!-- 1. Panel Estudiantes -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info shadow-sm">
                <div class="inner">
                    <h3>{{ $totalEstudiantes ?? 0 }}</h3>
                    <p>Total Estudiantes (Red)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="{{ route('estudiantes.index') }}" class="small-box-footer">Ver tabla de estudiantes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <!-- 2. Panel Centros -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success shadow-sm">
                <div class="inner">
                    <h3>{{ $totalCentros ?? 0 }}</h3>
                    <p>Centros Interconectados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-school"></i>
                </div>
                <a href="{{ route('centros.index') }}" class="small-box-footer">Administrar red <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <!-- 3. Panel Docentes -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-purple shadow-sm">
                <div class="inner">
                    <h3>{{ $totalDocentes ?? 0 }}</h3>
                    <p>Total Docentes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="{{ route('docentes.index') }}" class="small-box-footer">Ver lista de profesores <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- 4. Panel Asistencia -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning shadow-sm">
                <div class="inner">
                    <h3 class="text-white">Asistencia</h3>
                    <p class="text-white">Control Diario</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check text-white"></i>
                </div>
                <a href="{{ route('asistencia.index') }}" class="small-box-footer" style="color: white !important;">Registrar asistencia <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- 5. Panel Calificaciones -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-danger shadow-sm">
                <div class="inner">
                    <h3>Notas</h3>
                    <p>Registro de Calificaciones</p>
                </div>
                <div class="icon">
                    <i class="fas fa-edit"></i>
                </div>
                <a href="{{ route('calificaciones.index') }}" class="small-box-footer">Ir a calificaciones <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- 6. Panel Reportes -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary shadow-sm">
                <div class="inner">
                    <h3>Reportes</h3>
                    <p>Estadísticas MINED</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="{{ route('reportes.index') }}" class="small-box-footer">Ver reportes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- 7. NUEVO: Panel Traslados -->
        <div class="col-lg-4 col-6">
            <div class="small-box bg-secondary shadow-sm">
                <div class="inner">
                    <h3>Traslados</h3>
                    <p>Movimientos de Estudiantes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <a href="{{ route('traslados.index') }}" class="small-box-footer">Gestionar traslados <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@stop