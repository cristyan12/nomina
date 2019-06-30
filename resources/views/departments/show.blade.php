@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle del departamento #{{ $department->id }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Departamento:</span>
        <span class="lead"><strong>{{ $department->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Actualización:</span>
                    <span class="lead"><strong>{{ $department->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer">
        <div class="btn-group float-right">
            @can('departments.index')
                <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
            @endcan
            
            @can('departments.edit')
                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
            @endcan
        </div>
    </div>
@endcomponent
@endsection