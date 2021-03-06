@extends('layouts.master')

@section('content')

<div class="col-xs-9">
    <div class="card mb-3 shadow-sm">
        <div class="card-header lead font-weight-bold">
            #{{ $employee->code }}, {{ strtoupper($employee->full_name) }}
        </div>
        <div class="card-body">
            <div class="form-group d-flex">
                <div class="col-md-6">
                    <span class="lead font-weight-bold">Datos personales</span>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('familiars.index', $employee) }}" class="btn btn-outline-primary">
                        Cargas familiares
                    </a>
                </div>
            </div>
            <hr>
            <fieldset disabled>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Código: </label>
                        <input type="text" class="form-control" value="{{ $employee->code }}">
                    </div>
                    <div class="col-md-4">
                        <label>Nacionalidad: </label>
                        <input type="text" class="form-control" value="{{ strtoupper($employee->full_nationality) }}">
                    </div>
                    <div class="col-md-4">
                        <label>Cédula: </label>
                        <input type="text" class="form-control" value="{{ $employee->full_document }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>RIF:</label>
                        <input type="text" class="form-control" value="{{ $employee->rif }}">
                    </div>
                    <div class="col-md-4">
                        <label>Nació el:</label>
                        <input type="text" class="form-control" value="{{ $employee->born_at->format('d-m-Y') }}">
                    </div>
                    <div class="col-md-4">
                        <label>Edad:</label>
                        <input type="text" class="form-control" value="{{ $employee->born_at->age }} años">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Estado civil:</label>
                        <input type="text" class="form-control" value="{{ $employee->civil_status }}">
                    </div>
                    <div class="col-md-4">
                        <label>Sexo:</label>
                        <input type="text" class="form-control" value="{{ $employee->full_sex }}">
                    </div>
                    <div class="col-md-4">
                        <label>Ciudad de nacimiento:</label>
                        <input type="text" class="form-control" value="{{ $employee->city_of_born }}">
                    </div>
                </div>

                <div class="form-group">
                    <span class="lead font-weight-bold">Datos laborales</span>
                </div>

                <hr>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Departamento:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->department->name }}">
                    </div>
                    <div class="col-md-4">
                        <label>Sucursal:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->branch->name }}">
                    </div>
                    <div class="col-md-4">
                        <label>Unidad:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->unit->name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Status:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->status }}">
                    </div>
                    <div class="col-md-4">
                        <label>Contratado el:</label>
                        <input type="text" class="form-control" value="{{ $employee->hired_at->format('d-m-Y') }}">
                    </div>
                    <div class="col-md-4">
                        <label>Antiguedad:</label>
                        <input type="text" class="form-control" value="{{ $employee->diffAntiquity() }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Cargo:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->position->name }}">
                    </div>
                    <div class="col-md-3">
                        <label>Salario base diario:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->position->format_salary }}">
                    </div>
                    <div class="col-md-3">
                        <label>Salario base quincenal:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->position->nomina_quincenal }}">
                    </div>
                    <div class="col-md-3">
                        <label>Tipo de contrato:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->contract_type }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Profesión:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->profession->title }}">
                    </div>
                    <div class="col-md-4">
                        <label>Banco:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->bank->name }}">
                    </div>
                    <div class="col-md-4">
                        <label>Número de cuenta:</label>
                        <input type="text" class="form-control" value="{{ $employee->profile->account_number }}">
                    </div>
                </div>
            </fieldset>
        </div> {{-- .card-body --}}
        <div class="card-footer">
            <div class="btn-group float-right">
                @can('employees.index')
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
                @endcan
                @can('employees.edit')
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection