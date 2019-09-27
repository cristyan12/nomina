@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle del familiar #{{ $familiar->id }}, del empleado {{ $familiar->employee->full_name }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Nombre: </span><span class="lead"><strong>{{ $familiar->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Parentesco:</span>
                    <span class="lead"><strong>{{ $familiar->relationship }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Número de cédula:</span>
                    <span class="lead"><strong>{{ $familiar->document }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Género:</span>
                    <span class="lead"><strong>{{ $familiar->full_sex }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Nació el:</span>
                    <span class="lead"><strong>{{ $familiar->born_at->format('d-m-Y') }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Edad:</span>
                    <span class="lead"><strong>{{ $familiar->born_at->age }} años</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Grado de instrucción:</span>
                    <span class="lead"><strong>{{ $familiar->instruction }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Referencia:</span>
                    <span class="lead"><strong>{{ $familiar->reference }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Modificado:</span>
                    <span class="lead"><strong>{{ $familiar->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Por:</span>
                    <span class="lead"><strong>{{ $familiar->user->name }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer">
        <div class="btn-group float-right">
            @can('familiars.index')
                <a href="{{ route('familiars.index', $familiar->employee->id) }}"
                    class="btn btn-outline-secondary btn-sm">
                    Ir al listado
                </a>
            @endcan
            @can('familiars.edit')
                <a href="#" class="btn btn-outline-secondary btn-sm">Editar</a>
            @endcan
        </div>
    </div>
@endcomponent
@endsection
