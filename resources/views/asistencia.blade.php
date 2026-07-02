@extends('adminlte::page')
@section('title', 'Asistencia Diaria')
@section('content_header')
    <h1>Control de Asistencia Diaria</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    <div class="card card-outline card-warning">
        <div class="card-header bg-light">
            <h3 class="card-title text-sm font-weight-bold">Buscador de Asistencias Pasadas / Actuales</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('asistencia.index') }}" method="GET" class="row">
                <div class="col-md-5">
                    <label class="text-muted text-sm">Filtrar por Centro:</label>
                    <select name="centro_id" class="form-control" onchange="this.form.submit()">
                        <option value="">Todos los Centros (Vista Global)</option>
                        @foreach($centros as $centro)
                            <option value="{{ $centro->id }}" {{ $centro_id == $centro->id ? 'selected' : '' }}>{{ $centro->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="text-muted text-sm">Seleccionar Fecha a revisar:</label>
                    <input type="date" name="fecha" class="form-control" value="{{ $fecha_seleccionada }}" onchange="this.form.submit()">
                </div>
            </form>
        </div>
    </div>

    <form action="{{ route('asistencia.store') }}" method="POST">
        @csrf
        <input type="hidden" name="fecha" value="{{ $fecha_seleccionada }}">
        
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0 text-bold text-gray-700">
                            Lista de estudiantes para el día: <span class="text-warning">{{ date('d/m/Y', strtotime($fecha_seleccionada)) }}</span>
                        </h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-warning text-bold"><i class="fas fa-save"></i> Guardar Asistencia</button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle table-hover">
                    <thead class="bg-dark text-sm">
                        <tr>
                            <th>Estudiante</th>
                            <th>Grado</th>
                            <th>Centro</th>
                            <th class="text-center">Estado (Presente / Ausente)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estudiantes as $est)
                            @php
                                $estadoGuardado = isset($asistenciasGuardadas[$est->id]) ? $asistenciasGuardadas[$est->id]->estado : null;
                            @endphp
                            
                        <tr>
                            <td class="font-weight-bold">{{ $est->nombre_completo }}</td>
                            <td>{{ $est->grado }}</td>
                            <td><span class="badge bg-secondary">{{ $est->centro->nombre }}</span></td>
                            <td class="text-center">
                                <div class="icheck-success d-inline mr-4">
                                    <input type="radio" name="asistencia[{{ $est->id }}]" id="P_{{ $est->id }}" value="Presente" required {{ $estadoGuardado == 'Presente' ? 'checked' : '' }}>
                                    <label for="P_{{ $est->id }}">Presente</label>
                                </div>
                                <div class="icheck-danger d-inline">
                                    <input type="radio" name="asistencia[{{ $est->id }}]" id="A_{{ $est->id }}" value="Ausente" {{ $estadoGuardado == 'Ausente' ? 'checked' : '' }}>
                                    <label for="A_{{ $est->id }}">Ausente</label>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center p-4 text-muted">No hay estudiantes matriculados en esta selección.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>
@stop