@extends('adminlte::page')
@section('title', 'Reportes')
@section('content_header')
    <h1>Reportes y Estadísticas (MINED)</h1>
@stop

@section('content')
    <div class="row">
        @foreach($centros as $centro)
            @php
                // Simulación matemática basada en los datos reales de tu BD
                $total = $centro->estudiantes_count;
                $aprobados = $total > 0 ? round($total * 0.85) : 0;
                $reprobados = $total - $aprobados;
            @endphp
            <div class="col-md-4">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold text-sm">{{ $centro->nombre }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-sm mb-3"><i class="fas fa-users"></i> Matrícula Total: <b>{{ $total }} estudiantes</b></p>
                        <div class="d-flex justify-content-between text-center">
                            <div class="text-success">
                                <h5><i class="fas fa-check-circle"></i> {{ $aprobados }}</h5>
                                <span class="text-sm">Aprobados (Est.)</span>
                            </div>
                            <div class="text-danger border-left pl-4">
                                <h5><i class="fas fa-times-circle"></i> {{ $reprobados }}</h5>
                                <span class="text-sm">Reprobados (Est.)</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-0">
                        <button class="btn btn-block btn-primary btn-sm rounded-0" onclick="alert('Enviando consolidado al MINED...')">
                            <i class="fas fa-upload"></i> Enviar al MINED
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop