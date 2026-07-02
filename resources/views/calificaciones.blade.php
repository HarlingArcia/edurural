@extends('adminlte::page')
@section('title', 'Registro de Notas')

@section('content')
<div class="card">
    <div class="card-header bg-danger text-white"><h3>Registro de Calificaciones</h3></div>
    <div class="card-body">
        <table class="table table-bordered text-sm">
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Grado</th>
                    <th>Materias</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estudiantes as $est)
                @php $materias = \App\Http\Controllers\CalificacionController::getMaterias($est->grado); @endphp
                <tr>
                    <td class="font-weight-bold">{{ $est->nombre_completo }}</td>
                    <td>{{ $est->grado }}</td>
                    <td>
                        <div class="row">
                            @foreach($materias as $materia)
                            <div class="col-md-3 mb-2">
                                <label class="small text-muted">{{ $materia }}</label>
                                <input type="number" name="notas[{{ $est->id }}][{{ $materia }}]" 
                                       class="form-control form-control-sm" placeholder="0-100">
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop