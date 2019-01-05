@extends('layouts.master')

@section('title', 'Detalle de la sucursal')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header lead">Sucursal #{{ $branch->id }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><b>Sucursal: </b></p>
                    <p><b>Última actualización: </b></p>
                </div>
                <div class="col-md-8">
                    <p>{{ $branch->name }}</p>
                    <p>{{ $branch->updated_at->format('d-m-Y') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('branches.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection