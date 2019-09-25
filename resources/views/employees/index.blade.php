@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Empleados</h1>
@can('employees.create')
<p>
    <a href="{{ route('employees.create') }}" class="btn btn-outline-primary">Nuevo Empleado</a>
</p>
@endcan
@endsection

@section('content')

@if(! $employees->count() == 0)
<table class="table table-striped table-hover">
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
            @can('employees.show')
            <td width="10px">
                <a class="btn btn-outline-info btn-sm" href="{{ route('employees.show', $employee) }}">
                    Detalle
                </a>
            </td>
            @endcan
            @can('employees.edit')
            <td width="10px">
                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-outline-warning btn-sm">
                    Editar
                </a>
            </td>
            @endcan
            @can('employees.destroy')
            <td width="10px">
                <a href="#" class="btn btn-outline-danger btn-sm">
                    Eliminar
                </a>
            </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>

{{ $employees->render() }}
@else
    <p class="lead">No hay Empleados registrados aún.</p>
@endif
@endsection