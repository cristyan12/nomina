@extends('layouts.master')

@section('title')
<div class="display-4">Unidades</div>

<a href="{{ route('units.create') }}" class="btn btn-outline-primary">Nueva Unidad</a>
@endsection

@section('content')

@if(! $units->count() == 0)
<table class="table table-borderless table-striped table-hover">
    <tr>
        <thead class="bg-dark text-white">
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Unidad</div></th>
            <th colspan="2">
                &nbsp;
            </th>
        </thead>
    </tr>
    <tbody>
    @foreach($units as $unit)
        <tr>
            <td>{{ $unit->id }}</td>
            <td>{{ $unit->name }}</td>
            <td>
                <a class="btn btn-outline-info btn-sm" href="{{ route('units.show', $unit) }}">
                    Ver detalle
                </a>
            </td>
            <td>
                <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-outline-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $units->render() }}
@else
    <p class="lead">No hay Unidades de producción registradas aún.</p>
@endif
@endsection