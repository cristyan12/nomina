@extends('layouts.master')

@section('title')
<div class="display-4">Sucursales</div>

<a href="{{ route('branches.create') }}" class="btn btn-outline-primary">Nueva Sucursal</a>
@endsection

@section('content')

@if(! $branches->count() == 0)
<table class="table table-borderless table-striped table-hover">
    <tr>
        <thead class="bg-dark text-white">
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Sucursal</div></th>
            <th colspan="2">
                &nbsp;
            </th>
        </thead>
    </tr>
    <tbody>
    @foreach($branches as $branch)
        <tr>
            <td>{{ $branch->id }}</td>
            <td>{{ $branch->name }}</td>
            <td>
                <a class="btn btn-outline-info btn-sm" href="{{ route('branches.show', $branch) }}">
                    Ver detalle
                </a>
            </td>
            <td>
                <a href="{{ route('branches.edit', $branch) }}" class="btn btn-outline-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $branches->render() }}
@else
    <p class="lead">No hay sucursales registradas aún.</p>
@endif
@endsection