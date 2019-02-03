@extends('layouts.master')

@section('title', 'Detalle del empleado')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header lead">Detalle del empleado #{{ $employee->id }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><b>Código: </b></p>
                    <p><b>Documento: </b></p>
                    <p><b>Nombres: </b></p>
                    <p><b>Apellidos: </b></p>
                    <p><b>RIF: </b></p>
                    <p><b>Nació el: </b></p>
                    <p><b>Sexo: </b></p>
                    <p><b>Ciudad de nacimiento: </b></p>
                </div>
                <div class="col-md-8">
                    <p>{{ $employee->code }}</p>
                    <p>{{ $employee->document }}</p>
                    <p>{{ $employee->first_name }}</p>
                    <p>{{ $employee->last_name }}</p>
                    <p>{{ $employee->rif }}</p>
                    <p>{{ $employee->born_at->format('d-m-Y') }}</p>
                    <p>{{ $employee->sex }}</p>
                    <p>{{ $employee->city_of_born }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                <a href="#" class="btn btn-outline-secondary btn-sm">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection