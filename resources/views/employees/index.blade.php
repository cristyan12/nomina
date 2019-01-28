@extends('layouts.master')

@section('title')
<div class="display-4">Empleados</div>

<a href="{{ route('employees.create') }}" class="btn btn-outline-primary">Nuevo Empleado</a>
@endsection

@section('content')

@if(! $employees->count() == 0)
<table class="table table-borderless table-striped table-hover">
    <tr>
        <thead class="bg-dark text-white">
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Documento</div></th>
            <th><div class="lead">Apellido</div></th>
            <th><div class="lead">Nombre</div></th>
            <th><div class="lead">Contrat.</div></th>
            <th><div class="lead">Departamento</div></th>
            <th><div class="lead">Cargo</div></th>
            <th colspan="3">
                &nbsp;
            </th>
        </thead>
    </tr>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->document }}</td>
            <td>{{ $employee->last_name }}</td>
            <td>{{ $employee->first_name }}</td>
            <td>{{ $employee->hired_at }}</td>
            <td>Departamento</td>
            <td>Cargo</td>
            <td width="10px">
                <a class="btn btn-outline-info btn-sm" href="#">
                    Ver detalle
                </a>
            </td>
            <td width="10px">
                <a href="#" class="btn btn-outline-warning btn-sm">
                    Editar
                </a>
            </td>
            <td width="10px">
                <a href="#" class="btn btn-outline-danger btn-sm">
                    Eliminar
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $employees->render() }}
@else
    <p class="lead">No hay Empleados registrados aún.</p>
@endif
@endsection