@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle de la nómina {{ $nomina->name }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Nombre: </span><span class="lead"><strong>{{ $nomina->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Tipo:</span>
                    <span class="lead"><strong>{{ $nomina->type }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Número de períodos:</span>
                    <span class="lead"><strong>{{ $nomina->numbers_periods }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Fecha de 1er período:</span>
                    <span class="lead"><strong>{{ $nomina->first_date_period }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Fecha de Últ. período:</span>
                    <span class="lead"><strong>{{ $nomina->last_date_period }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Modificado:</span>
                    <span class="lead"><strong>{{ $nomina->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Por:</span>
                    <span class="lead"><strong>{{ $nomina->user->name }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer">
        <div class="btn-group float-right">
            @can('nominas.index')
                <a href="{{ route('nomina.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
            @endcan
            @can('nominas.edit')
                <a href="{{ route('nomina.edit', $nomina->id) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
            @endcan
        </div>
    </div>
@endcomponent
@endsection
