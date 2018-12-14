@extends('layouts.master')

@section('title')
<div class="display-4">Tabulador de cargos CCP 2017-2019</div>

<a href="{{ route('positions.create') }}" class="btn btn-outline-primary">Nuevo Cargo</a>
@endsection

@section('content')
<table class="table table-striped table-hover">
    <thead class="bg-dark text-white">
        <tr>
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Código SISDEM</div></th>
            <th><div class="lead">Nombre del cargo</div></th>
            <th><div class="lead">Salario Básico</div></th>
            <th colspan="3">
                &nbsp;
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($positions as $position)
            <tr>
                <td>{{ $position->id }}</td>
                <td>{{ $position->code }}</td>
                <td>{{ $position->name }}</td>
                <td>{{ $position->format_salary }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('positions.show', $position) }}">
                        Ver detalle
                    </a>
                </td>
                <td>ACCIÓN: MODIFICAR</td>
                <td>ACCIÓN: ?</td>
            </tr>
        @empty
            <p class="lead">No hay cargos registrados aún.</p>
        @endforelse
    </tbody>
</table>
@endsection