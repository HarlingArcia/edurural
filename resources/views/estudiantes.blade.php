@extends('adminlte::page')

@section('title', 'Matrícula')

@section('content_header')
    <h1>Gestión de Estudiantes</h1>
@stop

@section('content')
    <!-- Alertas de éxito o error personalizadas -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Alertas de validación de Laravel (ej. Código único) -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de Registro -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Nueva Matrícula</h3>
        </div>
        <form action="{{ route('estudiantes.store') }}" method="POST">
            @csrf
            <div class="card-body row">
                <div class="form-group col-md-3">
                    <label>Código MINED</label>
                    <input type="text" name="codigo_mined" class="form-control" value="{{ old('codigo_mined') }}" required placeholder="Ej. MIN-123">
                </div>
                <div class="form-group col-md-4">
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Edad</label>
                    <input type="number" name="edad" class="form-control" value="{{ old('edad') }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Sexo</label>
                    <select name="sexo" class="form-control" required>
                        <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label>Centro Educativo</label>
                    <select name="centro_id" class="form-control" required>
                        @foreach($centros as $centro)
                            <option value="{{ $centro->id }}" {{ old('centro_id') == $centro->id ? 'selected' : '' }}>{{ $centro->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Grado (Ej. 1ro Primaria)</label>
                    <input type="text" name="grado" class="form-control" value="{{ old('grado') }}" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Modalidad</label>
                    <select name="modalidad" class="form-control" required>
                        <option value="Matutino" {{ old('modalidad') == 'Matutino' ? 'selected' : '' }}>Matutino</option>
                        <option value="Vespertino" {{ old('modalidad') == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar Estudiante</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID MINED</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Centro Educativo</th>
                        <th>Grado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($estudiantes as $est)
                    <tr>
                        <td>{{ $est->codigo_mined }}</td>
                        <td>{{ $est->nombre_completo }}</td>
                        <td>{{ $est->edad }}</td>
                        <td>{{ $est->centro->nombre }}</td>
                        <td><span class="badge bg-success">{{ $est->grado }}</span></td>
                        <td>
                            <form action="{{ route('estudiantes.destroy', $est->id) }}" method="POST" onsubmit="return confirm('¿Dar de baja?');">
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
@stopphp