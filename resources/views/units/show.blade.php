@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle de la unidad #{{ $unit->id }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Unidad:</span>
        <span class="lead"><strong>{{ $unit->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Actualización:</span>
                    <span class="lead"><strong>{{ $unit->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer">
        <div class="btn-group float-right">
            @can('units.index')
                <a href="{{ route('units.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
            @endcan

            @can('units.edit')
                <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
            @endcan
        </div>
    </div>
@endcomponent
@endsection