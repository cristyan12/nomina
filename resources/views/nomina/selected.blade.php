@extends('layouts.master')

@section('title')
    <h1 class="pb-1 display-4">Trabajadores de la {{ $nomina->name }}</h1>
@endsection

@section('content')
    @if (! empty($nomina->employees))
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Código</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>F. Contratación</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th>Salario Base</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($nomina->employees as $employee)
            <tr>
                <th scope="row">{{ $employee->document }}</th>
                <td>{{ $employee->code }}</td>
                <td>{{ $employee->full_name }}</td>
                <td>{{ $employee->hired_at->format('d-m-Y') }} </td>
                <td>{{ $employee->profile->department->name }}</td>
                <td>{{ $employee->profile->position->name }}</td>
                <td>{{ $employee->profile->position->format_salary }}</td>
                <td width="10px">ACCIONES</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No hay nóminas registradas.</p>
    @endif
@endsection