@extends('layouts.master')

@section('title')
<h1 class="pb-1">Unidades</h1>
<p>
    <a href="{{ route('units.create') }}" class="btn btn-outline-primary">Nuevo unidad</a>
</p>
@endsection

@section('content')

@if(! $units->count() == 0)

<div class="table-responsive">
    <table class="table table-borderless table-striped table-hover">
        <tr>
            <thead class="bg-dark text-white">
                <th><div class="lead">ID</div></th>
                <th><div class="lead">Unidad</div></th>
                <th><div class="lead">Actualización</div></th>
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
                <td>{{ $unit->updated_at->diffForHumans() }}</td>
                <td width="10px">
                    <a class="btn btn-outline-info btn-sm" href="{{ route('units.show', $unit) }}">
                        Detalle
                    </a>
                </td>
                <td width="10px">
                    <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-outline-warning btn-sm">
                        Editar
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $units->render() }}
@else
    <p class="lead">No hay Unidades de producción registradas aún.</p>
@endif
@endsection