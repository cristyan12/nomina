@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle del cargo #{{ $position->id }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Cargo: </span><span class="lead"><strong>{{ $position->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Código SISDEM:</span>
                    <span class="lead"><strong>{{ $position->code }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Nombre del cargo:</span>
                    <span class="lead"><strong>{{ $position->name }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Salario Básico:</span>
                    <span class="lead"><strong>{{ $position->format_salary }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Ultima modificación:</span>
                    <span class="lead"><strong>{{ $position->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer">
        <div class="btn-group float-right">
            <a href="{{ route('positions.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

            <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
        </div>
    </div>
@endcomponent
@endsection
