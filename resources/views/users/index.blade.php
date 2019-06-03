@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Usuarios</h1>
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
                <th colspan="3">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td width="10px">
                    @can('users.show')
                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-primary">Detalle</a>
                    @endcan
                </td>
                <td width="10px">
                    @can('users.edit')
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Editar</a>
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
{{-- @extends('layouts.master')

@section('title', 'Usuarios')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Usuarios</strong></div>

                <div class="card-body">
	                @forelse($users as $user)
	                <div class="table-responsive">
	                	<table>
                			<thead>
                			<tr>
                				<th>ID</th>
                				<th>Nombre</th>
                				<th>Email</th>
                				<th colspan="3">&nbsp;</th>
                			</tr>
                			</thead>
                			<tbody>
            				<tr>
                				<td>{{ $user->id }}</td>
                				<td>{{ $user->name }}</td>
                				<td>{{ $user->email }}</td>
                				<td width="10px">
                					<a href="{{ route('users.show', $user) }}">Detalle</a>
                				</td>
                				<td width="10px">
                					<a href="{{ route('users.edit', $user) }}">Editar</a>
                				</td>
                				<td width="10px">
                					<a href="{{ route('users.destroy', $user) }}">Eliminar</a>
                				</td>
            				</tr>
                			</tbody>
	                	</table>
	                </div>
	                @empty
	                <div class="lead">
	                	No hay usuarios registrados aún.
	                </div>
	                @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}