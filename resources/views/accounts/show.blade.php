@extends('layouts.master')

@section('content')

@component('layouts.components._show')
    @slot('cardHeader')
        Detalle del banco de la empresa {{ $account->company->name }}
    @endslot

    @slot('image')
        <img src="{{ asset('img/no-image.png') }}" class="card-img">
    @endslot

    @slot('cardTitle')
        <span class="lead"></span><span class="lead"><strong>{{ $account->company->name }}</strong></span>
    @endslot

    @slot('fields')
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Banco:</span>
                    <span class="lead"><strong>{{ $account->bank->name }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Tipo de cuenta: </span>
                    <span class="lead text-right"><strong>{{ $account->type }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Numero de cuenta: </span>
                    <span class="lead"><strong>{{ $account->number }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Firma autorizada 1: </span>
                    <span class="lead"><strong>{{ $account->auth1->full_name }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Firma autorizada 2: </span>
                    <span class="lead"><strong>{{ $account->auth2->full_name }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Modificado: </span>
                    <span class="lead"><strong>{{ $account->updated_at->diffForHumans() }}</strong></span>
                </div>
            </li>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <span class="lead">Por: </span>
                    <span class="lead"><strong>{{ $account->user->name }}</strong></span>
                </div>
            </li>
        </ul>
    @endslot

    <div class="card-footer border-info">
        <div class="btn-group float-right">
            @can('accounts.index')
                <a href="{{ route('accounts.index') }}" class="btn btn-outline-info btn-sm">Ir al listado</a>
            @endcan
            @can('accounts.edit')
                <a href="{{ route('accounts.edit', $account) }}" class="btn btn-outline-info btn-sm">Editar</a>
            @endcan
        </div>
    </div>
@endcomponent
@endsection
