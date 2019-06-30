@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Sucursales</h1>
<p>
    @can('branches.create')
        <a href="{{ route('branches.create') }}" class="btn btn-outline-primary">Nueva Sucursal</a>
    @endcan
</p>
@endsection

@section('content')

@if(! $branches->count() == 0)
<table class="table table-borderless table-striped table-hover">
    <tr>
        <thead class="bg-dark text-white">
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Sucursal</div></th>
            <th><div class="lead">Actualización</div></th>
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
            <td>{{ $branch->updated_at->diffForHumans() }}</td>
            @can('branches.show')
            <td width="10px">
                <a class="btn btn-outline-info btn-sm" href="{{ route('branches.show', $branch) }}">
                    Detalle
                </a>
            </td>
            @endcan
            @can('branches.edit')
            <td width="10px">
                <a href="{{ route('branches.edit', $branch) }}" class="btn btn-outline-warning btn-sm">
                    Editar
                </a>
            </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>

{{ $branches->render() }}
@else
    <p class="lead">No hay sucursales registradas aún.</p>
@endif
@endsection