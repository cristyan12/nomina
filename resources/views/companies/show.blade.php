@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle de la empresa #{{ $company->id }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead">Nombre: </span><span class="lead"><strong>{{ $company->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">RIF:</span>
                    <span class="lead"><strong>{{ strtoupper($company->rif) }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Dirección:</span>
                    <span class="lead text-right"><strong>{{ Str::limit($company->address) }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Teléfono:</span>
                    <span class="lead"><strong>{{ $company->phone_number }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Correo:</span>
                    <span class="lead"><strong>{{ $company->email }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Ciudad:</span>
                    <span class="lead"><strong>{{ $company->city }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Modificado:</span>
                    <span class="lead"><strong>{{ $company->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer border-info">
        <div class="btn-group float-right">
            {{-- @can('companys.index') --}}
                <a href="{{ route('companies.index') }}" class="btn btn-outline-info btn-sm">Ir al listado</a>
            {{-- @endcan --}}
            {{-- @can('companys.edit') --}}
                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-outline-info btn-sm">Editar</a>
            {{-- @endcan --}}
        </div>
    </div>
@endcomponent
@endsection
