@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle de la sucursal #{{ $branch->id }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Nombre de la Sucursal:</span>
        <span class="lead"><strong>{{ $branch->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Actualización:</span>
                    <span class="lead"><strong>{{ $branch->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer">
        <div class="btn-group float-right">
            <a href="{{ route('branches.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

            <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
        </div>
    </div>
@endcomponent
@endsection
