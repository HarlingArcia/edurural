@extends('adminlte::page')
@section('title', 'Registro de Notas')

@section('content')
    <div class="card card-outline card-danger">
        <div class="card-body">
            <form action="{{ route('calificaciones.index') }}" method="GET" class="row">
               
                <div class="col-md-4 mb-2">
                    <select name="centro_id" class="form-control" onchange="this.form.submit()">
                        <option value="">Todos los Centros (Vista Global)</option>
                        @foreach($centros as $centro)
                            <option value="{{ $centro->id }}" {{ isset($centro_id) && $centro_id == $centro->id ? 'selected' : '' }}>{{ $centro->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                
              
                <div class="col-md-6 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar por Nombre del estudiante o Código MINED..." value="{{ $buscar ?? '' }}">
                    </div>
                </div>
                
                <!-- Botón Buscar -->
                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-danger w-100">Buscar</button>
                </div>
            </form>
        </div>
    </div>

   
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h3 class="card-title mt-1">Registro de Calificaciones</h3>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-bordered table-striped text-sm m-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 20%;">Estudiante</th>
                        <th style="width: 15%;">Grado</th>
                        <th>Materias</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estudiantes as $est)
                    @php 
                        $materias = \App\Http\Controllers\CalificacionController::getMaterias($est->grado); 
                    @endphp
                    <tr>
                        <td>
                            <span class="font-weight-bold text-lg">{{ $est->nombre_completo }}</span><br>
                            <span class="badge bg-secondary mt-1">ID: {{ $est->codigo_mined }}</span>
                        </td>
                        <td class="align-middle">
                            <span class="text-muted font-weight-bold">{{ $est->grado }}</span>
                        </td>
                        <td>
                            <div class="row">
                                @foreach($materias as $materia)
                                <div class="col-md-3 mb-3">
                                    <label class="small text-muted mb-1">{{ $materia }}</label>
                                    <input type="number" name="notas[{{ $est->id }}][{{ $materia }}]" 
                                           class="form-control form-control-sm border-danger" placeholder="0 - 100" min="0" max="100">
                                </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center p-5 text-muted">
                            <h5><i class="fas fa-search text-gray-300"></i></h5>
                            No se encontraron estudiantes con ese nombre o código MINED.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop