@extends('layouts.master')

@section('title')
<div class="display-4">Departamentos</div>

@can('departments.create')
    <a href="{{ route('departments.create') }}" class="btn btn-outline-primary">Nuevo Departamento</a>
@endcan
@endsection

@section('content')

@if(! $departments->count() == 0)
<table class="table table-borderless table-striped table-hover">
    <tr>
        <thead class="bg-dark text-white">
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Departamento</div></th>
            <th><div class="lead">Actualización</div></th>
            <th colspan="2">
                &nbsp;
            </th>
        </thead>
    </tr>
    <tbody>
    @foreach($departments as $department)
        <tr>
            <td>{{ $department->id }}</td>
            <td>{{ $department->name }}</td>
            <td>{{ $department->updated_at->diffForHumans() }}</td>
            @can('departments.show')
            <td width="10px">
                <a class="btn btn-outline-info btn-sm" href="{{ route('departments.show', $department) }}">
                    Detalle
                </a>
            </td>
            @endcan
            @can('departments.edit')
            <td width="10px">
                <a href="{{ route('departments.edit', $department) }}" class="btn btn-outline-warning btn-sm">
                    Editar
                </a>
            </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>

{{ $departments->render() }}
@else
    <p class="lead">No hay Departamentos registrados aún.</p>
@endif
@endsection