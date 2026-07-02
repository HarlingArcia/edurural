@extends('adminlte::page')
@section('title', 'EduRural - Inicio')
@section('content_header')
    <h1>Panel de Inicio Global</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalEstudiantes }}</h3>
                    <p>Total Estudiantes (Red)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="{{ route('estudiantes.index') }}" class="small-box-footer">Ver tabla de estudiantes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalCentros }}</h3>
                    <p>Centros Interconectados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-school"></i>
                </div>
                <a href="{{ route('centros.index') }}" class="small-box-footer">Administrar red <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-4 col-6">
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{ $totalDocentes }}</h3>
                    <p>Total Docentes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <a href="{{ route('docentes.index') }}" class="small-box-footer">Ver lista de profesores <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Asistencia</h3>
                    <p>Control Diario</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check text-white"></i>
                </div>
                <a href="{{ route('asistencia.index') }}" class="small-box-footer" style="color: white !important;">Registrar asistencia <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
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

        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary">
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
    </div>
@stop