@extends('layouts.master')

@section('title')
<div class="display-4">Empleados</div>

<a href="{{ route('employees.create') }}" class="btn btn-outline-primary">Nuevo Empleado</a>
@endsection

@section('content')

@if(! $employees->count() == 0)
<table class="table table-bordered table-striped table-hover">
    <tr>
        <thead class="bg-dark text-white">
            <th>C. I.</th>
            <th>Nombre completo</th>
            <th>Contratación</th>
            <th>Departamento</th>
            <th>Cargo</th>
            <th colspan="3">
                &nbsp;
            </th>
        </thead>
    </tr>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->document }}</td>
            <td>{{ $employee->full_name }}</td>
            <td>{{ $employee->hired_at->format('d-m-Y') }}</td>
            <td>{{ str_limit($employee->profile->department->name, 25) }}</td>
            <td>{{ str_limit($employee->profile->position->name, 25) }}</td>
            <td width="10px">
                <a class="btn btn-outline-info btn-sm" href="{{ route('employees.show', $employee) }}">
                    Ver detalle
                </a>
            </td>
            <td width="10px">
                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-outline-warning btn-sm">
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