@extends('adminlte::page')
@section('title', 'Gestión de Traslados')
@section('content_header')
    <h1>Movimientos y Traslados de Estudiantes</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"><i class="fas fa-ban"></i> {{ session('error') }}</div>
    @endif
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
        <!-- Formulario (Izquierda) Ampliado a 5 columnas -->
        <div class="col-md-5">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title text-bold"><i class="fas fa-exchange-alt"></i> Hoja de Traslado</h3>
                </div>
                <form action="{{ route('traslados.store') }}" method="POST">
                    @csrf
                    <div class="card-body text-sm">
                        <!-- 1. Búsqueda de Estudiante -->
                        <div class="form-group">
                            <label>Buscar Estudiante (Código o Nombre)</label>
                            <select name="estudiante_id" id="estudiante_select" class="form-control" required>
                                <option value="" disabled selected>Seleccione un estudiante...</option>
                                @foreach($estudiantes as $est)
                                    <!-- Aquí inyectamos los datos ocultos para que JS los lea -->
                                    <option value="{{ $est->id }}" 
                                            data-centro="{{ $est->centro->nombre }}"
                                            data-edad="{{ $est->edad }}"
                                            data-grado="{{ $est->grado }}">
                                        {{ $est->codigo_mined }} - {{ $est->nombre_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 2. Pantalla dinámica del Centro Actual -->
                        <div id="box_centro_actual" class="alert alert-info py-2" style="display: none;">
                            <i class="fas fa-school"></i> <strong>Centro Actual:</strong> <span id="txt_centro_actual"></span>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Sexo</label>
                                <select name="sexo" class="form-control form-control-sm" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Edad</label>
                                <input type="number" name="edad_estudiante" id="input_edad" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Grado</label>
                                <input type="text" name="grado_estudiante" id="input_grado" class="form-control form-control-sm" readonly>
                            </div>
                        </div>

                        <hr>
                        <h6 class="text-bold text-muted">Datos del Tutor / Madre</h6>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nombre Completo</label>
                                <input type="text" name="nombre_tutor" class="form-control form-control-sm" value="{{ old('nombre_tutor') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Cédula Única</label>
                                <input type="text" name="cedula_tutor" class="form-control form-control-sm" value="{{ old('cedula_tutor') }}" placeholder="000-000000-0000A" required>
                            </div>
                        </div>

                        <hr>
                        <h6 class="text-bold text-muted">Datos de Destino</h6>

                        <div class="form-group">
                            <label>Escuela a Trasladar</label>
                            <select name="centro_destino_id" class="form-control form-control-sm" required>
                                <option value="" disabled selected>Seleccione la nueva escuela...</option>
                                @foreach($centros as $centro)
                                    <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Fecha</label>
                                <input type="date" name="fecha_traslado" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Motivo</label>
                                <input type="text" name="motivo" class="form-control form-control-sm" placeholder="Ej. Domicilio" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning w-100 text-bold">Aplicar Traslado Oficial</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla (Derecha) 7 columnas -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Historial de Traslados Realizados</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped text-sm">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Estudiante / Tutor</th>
                                <th>Movimiento (Origen a Destino)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($traslados as $t)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($t->fecha_traslado)) }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ $t->estudiante->nombre_completo }}</span><br>
                                    <small class="text-muted">Tutor: {{ $t->nombre_tutor }} ({{ $t->cedula_tutor }})</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $t->origen->nombre }}</span> 
                                    <i class="fas fa-arrow-right text-muted mx-1"></i> 
                                    <span class="badge bg-success">{{ $t->destino->nombre }}</span><br>
                                    <small class="text-muted">Motivo: {{ $t->motivo }}</small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center p-4 text-muted">No se han registrado traslados en la red.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    // Magia en JavaScript para mostrar el centro, edad y grado instantáneamente
    document.addEventListener('DOMContentLoaded', function() {
        var selectEst = document.getElementById('estudiante_select');
        selectEst.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];

            // Sacamos los datos ocultos del HTML
            var centro = selectedOption.getAttribute('data-centro');
            var edad = selectedOption.getAttribute('data-edad');
            var grado = selectedOption.getAttribute('data-grado');

            // Mostramos la caja azul con el centro actual
            document.getElementById('txt_centro_actual').innerText = centro;
            document.getElementById('box_centro_actual').style.display = 'block';

            // Autocompletamos edad y grado para ahorrar tiempo
            document.getElementById('input_edad').value = edad;
            document.getElementById('input_grado').value = grado;
        });
    });
</script>
@stop