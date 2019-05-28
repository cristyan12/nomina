@extends('layouts.master')

@section('title', 'Detalle del cargo')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header lead">Cargo #{{ $position->id }}</div>
                <div class="card-body">
                    <fieldset disabled>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                <strong>Código SISDEM:</strong>
                            </label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $position->code }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                <strong>Nombre del Cargo:</strong>
                            </label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $position->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                <strong>Salario Básico:</strong>
                            </label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $position->format_salary }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                <strong>Última actualización:</strong>
                            </label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $position->updated_at->format('d-m-Y') }}</p>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="card-footer">
                    <div class="btn-group float-right">
                        <a href="{{ route('positions.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection