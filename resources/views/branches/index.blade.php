@extends('layouts.master')

@section('title')
<div class="display-4">Sucursales</div>

<a href="{{ route('positions.create') }}" class="btn btn-outline-primary">Crear Sucursal</a>
@endsection

@section('content')
<table class="table table-striped table-hover">
    <thead class="bg-dark text-white">
        <tr>
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Sucursal</div></th>
            <th colspan="3">
                &nbsp;
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($branches as $branch)
            <tr>
                <td>{{ $branch->id }}</td>
                <td>{{ $branch->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="#">
                        Ver detalle
                    </a>
                </td>
                <td>
                    <a class="btn btn-secondary btn-sm" href="#">
                        Modificar
                    </a>
                </td>
                <td>ACCIÓN: ?</td>
            </tr>
        @empty
            <p class="lead">No hay sucursales registradas aún.</p>
        @endforelse
    </tbody>
</table>
@endsection