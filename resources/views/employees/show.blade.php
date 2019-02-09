@extends('layouts.master')

@section('title', 'Detalle del empleado')

@section('content')

<div class="col-md-9">
    <div class="card mb-3 shadow-sm">
        <div class="card-header lead">#{{ $employee->code }}, {{ $employee->full_name }}</div>
        <div class="card-body">
            <fieldset disabled>
                <div class="form-group row">
                    <div class="col">
                        <label>Código: </label>
                        <input type="text" class="form-control" value="{{ $employee->code }}">
                    </div>
                    <div class="col">
                        <label>Nacionalidad: </label>
                        <input type="text" class="form-control" value="{{ strtoupper($employee->full_nationality) }}">
                    </div>
                    <div class="col">
                        <label>Cédula: </label>
                        <input type="text" class="form-control" value="{{ $employee->full_document }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>RIF:</label>
                        <input type="text" class="form-control" value="{{ $employee->rif }}">
                    </div>
                    <div class="col">
                        <label>Nació el:</label>
                        <input type="text" class="form-control" value="{{ $employee->born_at->format('d M, Y') }}">
                    </div>
                    <div class="col">
                        <label>Edad:</label>
                        <input type="text" class="form-control" value="{{ $employee->born_at->age }} años">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col">
                        <label>Estado civil:</label>
                        <input type="text" class="form-control" value="{{ $employee->marital_status }}">
                    </div>
                    <div class="col">
                        <label>Sexo:</label>
                        <input type="text" class="form-control" value="{{ $employee->full_sex }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col">
                        <label>Ciudad de nacimiento:</label>
                        <input type="text" class="form-control" value="{{ $employee->city_of_born }}">
                    </div>
                    <div class="col">
                        <label>Contratado el:</label>
                        <input type="text" class="form-control" value="{{ $employee->hired_at->format('d M, Y') }}">
                    </div>
                    <div class="col">
                        <label>Antiguedad en años:</label>
                        <input type="text" class="form-control" value="{{ $employee->hired_at->age }} años">
                    </div>
                </div>
            </fieldset>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                <a href="#" class="btn btn-outline-secondary btn-sm">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection