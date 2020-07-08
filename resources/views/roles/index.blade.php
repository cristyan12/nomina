@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Roles</h1>
@can('roles.create')
<p>
    <a href="{{ route('roles.create') }}" class="btn btn-outline-primary">Nuevo Role</a>
</p>
@endcan
@endsection

@section('content')
    @if (! empty($roles))
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Slug</th>
                <th scope="col">Permiso especial</th>
                <th scope="col">Modificado</th>
                <th colspan="3">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
            <tr>
                <th scope="row">{{ $role->id }}</th>
                <td>{{ $role->name }}</td>
                <td>{{ $role->slug }}</td>
                <td>{{ $role->special ?: 'N/D' }}</td>
                <td>{{ $role->updated_at->diffForHumans() }}</td>
                <td width="10px">
                    @can('roles.show')
                        <a href="{{ route('roles.show', $role) }}" class="btn btn-sm btn-outline-primary">Detalle</a>
                    @endcan
                </td>
                <td width="10px">
                    @can('roles.edit')
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                    @endcan
                </td>
                <td width="10px">
                    <form action="{{ route('roles.destroy', $role) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        @can('roles.destroy')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No hay Roles registrados.</p>
    @endif
@endsection