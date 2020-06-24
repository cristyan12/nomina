@extends('layouts.master')

@section('title')
    <h1 class="pb-1 display-4">{{ $nomina->name }}</h1>

    <p>
        <a class="btn btn-outline-secondary" href="{{ route('pre-nominas.index') }}">
            Ir al listado de las nóminas del sistema
        </a>
    </p>
@endsection

@section('content')
    @if (! $employees->isEmpty())
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="row">#</th>
                <th scope="row">CÉDULA</th>
                <th>NOMBRE</th>
                <th>DEPARTAMENTO</th>
                <th>CARGO</th>
                <th>SALARIO BASE</th>
                <th scope="row">HEXTRAS</th>
                <th>TVIAJE</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td width="10px">{{ $employee->id }}</td>
                    <td width="10px">{{ $employee->document }}</td>
                    <td>{{ str_limit($employee->full_name, 23) }}</td>
                    <td>{{ str_limit($employee->profile->department->name, 20) }}</td>
                    <td>{{ strtoupper($employee->profile->position->name) }}</td>
                    <td>{{ $employee->profile->position->format_salary }}</td>
                    <td>Horas</td>
                    <td>Tiempo de viaje</td>
                    <td>
                        <a href="{{ url("pre-nominas/{$nomina->id}/{$employee->id}/create") }}"
                            class="btn btn-outline-warning btn-sm"
                        >Carga de datos</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $employees->render() }}
    @else
        <p class="lead">No hay trabajadores registrados en esta nómina.</p>
    @endif
@endsection