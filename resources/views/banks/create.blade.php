@extends('layouts.master')

@section('title', 'Crear Banco')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Bancos</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'banks.store']) }}

                @include('banks.partials.form')

            {{ Form::close() }}
        </div>
        <div class="card-footer">
            <blockquote class="blockquote-footer mt-3 mb-0">
                Los campos marcados con (*) son obligatorios.
            </blockquote>
            
            <div class="btn-group float-right">
                <a href="{{ route('banks.index') }}" class="btn btn-outline-secondary btn-sm">
                    Ir al listado
                </a>
            </div>
        </div>
    </div>
</div>
@endsection