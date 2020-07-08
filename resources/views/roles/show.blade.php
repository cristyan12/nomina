@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle del role #{{ $role->id }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Nombre: </span><span class="lead"><strong>{{ $role->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">URL Amigable:</span>
                    <span class="lead"><strong>{{ $role->slug }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Descripción:</span>
                    <span class="lead"><strong>{{ $role->description }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Permiso especial:</span>
                    <span class="lead"><strong>{{ $role->special ?: 'N/D' }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Actualización:</span>
                    <span class="lead"><strong>{{ $role->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer">
        <div class="btn-group float-right">
            @can('roles.index')
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
            @endcan

            @can('roles.edit')
                <a href="{{ route('roles.edit', $role) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
            @endcan
        </div>
    </div>
@endcomponent
@endsection
