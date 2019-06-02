@extends('layouts.master')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">Usuarios</h1>
        <p>
            <a href="#" class="btn btn-primary">Nuevo usuario</a>
        </p>
    </div>

    @if ($users->isNotEmpty())
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a href="{{ route('users.show', $user) }}" class="btn btn-link"><span class="oi oi-eye"></span></a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-link"><span class="oi oi-pencil"></span></a>
                    <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
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