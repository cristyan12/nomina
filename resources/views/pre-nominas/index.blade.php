@extends('layouts.master')

@section('title')
    <h1 class="pb-1 display-4">Nóminas</h1>
@endsection

@section('content')
    @if (! empty($nominas))
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Número de perídos</th>
                <th scope="col">Desde</th>
                <th scope="col">Hasta</th>
                <th colspan="2">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($nominas as $nomina)
            <tr>
                <th scope="row">{{ $nomina->id }}</th>
                <td>{{ $nomina->name }}</td>
                <td>{{ $nomina->type }}</td>
                <td>{{ $nomina->periods ?: 'No/D' }}</td>
                <td>{{ $nomina->first_date_period }}</td>
                <td>{{ $nomina->last_date_period }}</td>
                <td width="10px">
                    <a href="{{ route('nomina.edit', $nomina) }}" class="btn btn-sm btn-outline-warning">
                        Editar
                    </a>
                </td>
                <td width="10px">
                    <a href="{{ route('pre-nominas.show', $nomina) }}" class="btn btn-sm btn-outline-info">
                        Seleccionar
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No hay nóminas registradas.</p>
    @endif
@endsection