@extends('layouts.master')

@section('title', 'Detalle del contrato')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header lead">Contrato #{{ $contract->id }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><b>Tipo: </b></p>
                    <p><b>Duración: </b></p>
                    <p><b>Última actualización: </b></p>
                </div>
                <div class="col-md-8">
                    <p>{{ $contract->type }}</p>
                    <p>{{ $contract->duration }}</p>
                    <p>{{ $contract->updated_at->format('d-m-Y') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection