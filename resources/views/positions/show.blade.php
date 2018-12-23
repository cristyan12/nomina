@extends('layouts.master')

@section('title', 'Detalle del cargo')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header lead">Cargo #{{ $position->id }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><b>Código SISDEM: </b></p>
                    <p><b>Nombre del Cargo: </b></p>
                    <p><b>Salario Básico: </b></p>
                    <p><b>Última actualización: </b></p>
                </div>
                <div class="col-md-8">
                    <p>{{ $position->code }}</p>
                    <p>{{ $position->name }}</p>
                    <p>{{ $position->format_salary }}</p>
                    <p>{{ $position->updated_at->format('d-m-Y') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('positions.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection