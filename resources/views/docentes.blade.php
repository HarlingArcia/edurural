@extends('adminlte::page')
@section('title', 'Plantilla Docente')
@section('content_header')
    <h1>Gestión de Profesores</h1>
@stop

@section('content')
    <!-- Alertas -->
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"><i class="fas fa-ban"></i> {{ session('error') }}</div>
    @endif
    
    <!-- Alerta de Cédula duplicada (Validación de Laravel) -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <!-- Formulario (Izquierda) - Ampliado a col-md-5 para que quepan bien los campos -->
        <div class="col-md-5">
            <div class="card card-purple">
                <div class="card-header">
                    <h3 class="card-title">Registrar Nuevo Maestro</h3>
                </div>
                <form action="{{ route('docentes.store') }}" method="POST">
                    @csrf
                    <div class="card-body text-sm">
                        
                        <div class="form-group">
                            <label>Nombre y Apellidos</label>
                            <input type="text" name="nombre_completo" class="form-control form-control-sm" value="{{ old('nombre_completo') }}" placeholder="Ej. Ana Ramírez" required>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Cédula de Identidad</label>
                                <input type="text" name="cedula" class="form-control form-control-sm" value="{{ old('cedula') }}" placeholder="000-000000-0000A" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Edad</label>
                                <input type="number" name="edad" class="form-control form-control-sm" value="{{ old('edad') }}" placeholder="Ej. 35">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Teléfono</label>
                                <input type="text" name="telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" placeholder="Ej. 8888-8888">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Correo (Gmail)</label>
                                <input type="email" name="gmail" class="form-control form-control-sm" value="{{ old('gmail') }}" placeholder="ejemplo@gmail.com">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Lugar de donde es (Dirección)</label>
                            <input type="text" name="lugar" class="form-control form-control-sm" value="{{ old('lugar') }}" placeholder="Ej. Sector Tola, Barrio Central">
                        </div>

                        <div class="form-group">
                            <label>Experiencia Laboral</label>
                            <input type="text" name="experiencia_laboral" class="form-control form-control-sm" value="{{ old('experiencia_laboral') }}" placeholder="Ej. 5 años impartiendo clases">
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Especialidad</label>
                                <input type="text" name="especialidad" class="form-control form-control-sm" value="{{ old('especialidad') }}" placeholder="Ej. Matemáticas">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Grado que imparte</label>
                                <input type="text" name="grado" class="form-control form-control-sm" value="{{ old('grado') }}" placeholder="Ej. 1er año" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Centro Educativo Asignado</label>
                            <select name="centro_id" class="form-control form-control-sm" required>
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

        <!-- Tabla (Derecha) - Ajustado a col-md-7 -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Plantilla Docente Activa</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped text-sm">
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
                                <td class="font-weight-bold">
                                    {{ $maestro->nombre_completo }}<br>
                                    <small class="text-muted">Cédula: {{ $maestro->cedula }}</small>
                                </td>
                                <td>{{ $maestro->especialidad ?? '-' }}</td>
                                <td><span class="badge bg-info">{{ $maestro->grado }}</span></td>
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