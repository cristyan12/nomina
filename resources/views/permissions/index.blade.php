@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Permisos</h1>
@can('permissions.create')
<p>
    <a href="{{ route('permissions.create') }}" class="btn btn-outline-primary">Crear permiso</a>
</p>
@endcan
@endsection

@section('content')
    @if (! empty($permissions))
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">URL Amigable</th>
                <th colspan="2">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
            <tr>
                <th scope="row">{{ $permission->id }}</th>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->slug }}</td>
                @can('permissions.show')
                    <td width="10px">
                        <a href="{{ route('permissions.show', $permission) }}" class="btn btn-sm btn-outline-info">Detalle</a>
                    </td>
                @endcan
                @can('permissions.edit')
                    <td width="10px">
                        <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                    </td>
                @endcan
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $permissions->render() }}
    @else
        <p>No hay permisos registrados.</p>
    @endif
@endsection