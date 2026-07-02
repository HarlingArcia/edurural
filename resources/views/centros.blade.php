@extends('adminlte::page')

@section('title', 'Red de Centros')

@section('content_header')
    <h1>Gestión de la Red de Centros</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-ban"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Agregar Nuevo Centro</h3>
                </div>
                <form action="{{ route('centros.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Código del Centro</label>
                            <input type="text" name="codigo" class="form-control" placeholder="Ej. C-07" required>
                        </div>
                        <div class="form-group">
                            <label>Nombre de la Escuela</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej. Escuela San José" required>
                        </div>
                        <div class="form-group">
                            <label>Cantidad de Docentes</label>
                            <input type="number" name="maestros" class="form-control" required min="1">
                        </div>
                        <div class="form-group">
                            <label>Estado de Red</label>
                            <select name="estado" class="form-control" required>
                                <option value="Sincronizado">Sincronizado</option>
                                <option value="Pendiente">Pendiente</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-block"><i class="fas fa-plus"></i> Registrar Centro en la Red</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Centros Educativos Registrados</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th class="text-center">Docentes</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($centros as $centro)
                            <tr>
                                <td class="font-weight-bold text-muted">{{ $centro->codigo }}</td>
                                <td class="font-weight-bold text-info">{{ $centro->nombre }}</td>
                                <td class="text-center">{{ $centro->maestros }}</td>
                                <td class="text-center">
                                    @if($centro->estado == 'Sincronizado')
                                        <span class="badge bg-success"><i class="fas fa-check"></i> Sincronizado</span>
                                    @else
                                        <span class="badge bg-warning"><i class="fas fa-clock"></i> Pendiente</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('centros.destroy', $centro->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este centro? Esto podría afectar a los estudiantes matriculados en él.');">
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