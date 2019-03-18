@extends('layouts.master')

@section('title', 'Empleados')

@section('content')

<div class="col-xs-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Editar Empleado con el ID #{{ $employee->id }}: {{ $employee->full_name }}</strong></div>
        <div class="card-body">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="code">Código:*</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{ $employee->code }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="document">Documento de identidad:*</label>
                        <input type="text" name="document" id="document" class="form-control" value="{{ $employee->document }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nationality">Nacionalidad:</label>
                        {{ Form::select('nationality', ['V' => 'Venezolana', 'E' => 'Extranjera'], null, ['class' => 'custom-select' ]) }}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="last_name">Apellidos:*</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $employee->last_name }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="first_name">Nombres:*</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $employee->first_name }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rif">Registro de Información Fiscal (RIF):*</label>
                        <input type="text" id="rif" name="rif" class="form-control" value="{{ $employee->rif }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="born_at">Fecha de nacimiento:*</label>
                        <input type="date" id="born_at" name="born_at" class="form-control" value="{{ old('born_at') or $employee->born_at }}">
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm">
                    Ir al listado
                </a>
            </div>
        </div>
    </div>
</div>
@endsection