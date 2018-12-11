@extends('layouts.master')

@section('title', 'Tabulador de cargos CCP 2017-2019')

@section('content')
<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Código SISDEM</th>
            <th>Nombre del cargo</th>
            <th>Salario Básico</th>
        </tr>
    </thead>
    <tbody>
        @forelse($positions as $position)
            <tr>
                <td>{{ $position->id }}</td>
                <td>{{ $position->code }}</td>
                <td>{{ $position->name }}</td>
                <td>{{ $position->basic_salary }}</td>
            </tr>
        @empty
            <p class="lead">No hay cargos registrados aún.</p>
        @endforelse
    </tbody>
</table>
@endsection