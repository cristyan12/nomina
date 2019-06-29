@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Usuarios</h1>
@can('users.create')
<p>
    <a href="{{ route('users.create') }}" class="btn btn-outline-primary">Nuevo Usuario</a>
</p>
@endcan
@endsection

@section('content')
    @if (! empty($users))
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Modificado</th>
                <th colspan="3">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
                <td width="10px">
                    @can('users.show')
                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-primary">Detalle</a>
                    @endcan
                </td>
                <td width="10px">
                    @can('users.edit')
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                    @endcan
                </td>
                <td width="10px">
                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        @can('users.destroy')
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
        <p>No hay usuarios registrados.</p>
    @endif
@endsection

@section('sidebar')
    @parent
@endsection