@extends('adminlte::page')
@section('title', 'Plantilla Docente')
@section('content_header')
    <h1>Gestión de Profesores</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"><i class="fas fa-ban"></i> {{ session('error') }}</div>
    @endif

    <div class="row">
        <!-- Formulario (Izquierda) -->
        <div class="col-md-4">
            <div class="card card-purple">
                <div class="card-header">
                    <h3 class="card-title">Registrar Nuevo Maestro</h3>
                </div>
                <form action="{{ route('docentes.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" name="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}" placeholder="Ej. Ana Ramírez" required>
                        </div>
                        
                        <!-- NUEVO: Campos separados -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Especialidad</label>
                                <input type="text" name="especialidad" class="form-control" value="{{ old('especialidad') }}" placeholder="Ej. Matemáticas">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Grado que imparte</label>
                                <input type="text" name="grado" class="form-control" value="{{ old('grado') }}" placeholder="Ej. 1er año" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Centro Educativo Asignado</label>
                            <select name="centro_id" class="form-control" required>
                                <option value="" disabled {{ old('centro_id') ? '' : 'selected' }}>Seleccione una escuela...</option>
                                @foreach($centros as $centro)
                                    <option value="{{ $centro->id }}" {{ old('centro_id') == $centro->id ? 'selected' : '' }}>{{ $centro->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-purple"><i class="fas fa-save"></i> Guardar Profesor</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla (Derecha) -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Plantilla Docente Activa</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Grado</th>
                                <th>Escuela Asignada</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docentes as $maestro)
                            <tr>
                                <td class="font-weight-bold">{{ $maestro->nombre_completo }}</td>
                                <td>{{ $maestro->especialidad ?? 'N/A' }}</td>
                                <td><span class="badge badge-info">{{ $maestro->grado ?? 'N/A' }}</span></td>
                                <td><span class="badge bg-purple">{{ $maestro->centro->nombre }}</span></td>
                                <td>
                                    <form action="{{ route('docentes.destroy', $maestro->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar a este profesor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop