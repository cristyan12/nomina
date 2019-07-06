@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle del usuario #{{ $user->id }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Nombre: </span>
        <span class="lead"><strong>{{ $user->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Correo:</span>
                    <span class="lead"><strong>{{ $user->email }}</strong></span>
                </div>
            </li>
            @foreach($user->roles as $role)
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Rol Activo:</span>
                    <span class="lead"><strong>{{ $role->name }}</strong></span>
                </div>
            </li>
            @endforeach
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Actualización:</span>
                    <span class="lead"><strong>{{ $user->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer">
        <div class="btn-group float-right">
            @can('users.index')
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
            @endcan
            @can('users.edit')
                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
            @endcan
        </div>
    </div>
@endcomponent
@endsection
