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
                        <input type="date" id="born_at" name="born_at" class="form-control"
                        	value="{{ $employee->born_at->format('Y-m-d') }}"
                        >
                    </div>
                </div>

                <div class="form-row">
                	<div class="form-group col-md-6">
					    {{ Form::label('marital_status', 'Estado Civil:*') }}
					    {{ Form::select('marital_status', [
					    	'Soltero/a' => 'Soltero/a',
					    	'Casado/a' => 'Casado/a',
					    	'Viudo/a' => 'Viudo/a'
					    ], $employee->marital_status, ['class' => 'custom-select']) }}
					</div>

					<div class="form-group col-md-6">
					    {{ Form::label('sex', 'Sexo:*') }}
					    {{ Form::select('sex', ['M' => 'Masculino', 'F' => 'Femenino'], $employee->sex, [
					    	'class' => 'custom-select',
					    	'placeholder' => 'Seleccione una opción:'
					    ]) }}
                	</div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city_of_born">Ciudad de nacimiento:*</label>
                        <input type="text" id="city_of_born" name="city_of_born"
                            class="form-control" value="{{ $employee->city_of_born }}"
                        >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="hired_at">Fecha de contratación:*</label>
                        <input type="date" id="hired_at" name="hired_at"
                            class="form-control" value="{{ $employee->hired_at->format('Y-m-d') }}"
                        >
                    </div>
                </div>

                <div class="form-row">
					<div class="form-group col-md-6">
					    {{ Form::label('profession_id', 'Profesión:*') }}
					    {{ Form::select('profession_id', $professions, $employee->profile->profession_id, [
					    	'class' => 'custom-select',
					    	'placeholder' => 'Seleccione una opción:'
					    ]) }}
					</div>

					<div class="form-group col-md-6">
						{{ Form::label('contract', 'Tipo de contrato:*') }}
					    {{ Form::select('contract', ['T' => 'Temporal', 'I' => 'Indefinido'], $employee->profile->contract, [
					    	'class' => 'custom-select',
					    	'placeholder' => 'Seleccione una opción:'
					    ]) }}
					</div>
				</div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('bank_pay_id', 'Banco:*') }}
                        {{ Form::select('bank_pay_id', $bankOfPays, $employee->profile->bank_pay_id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('account_number', 'Número de cuenta:*') }}
                        {{ Form::text('account_number', $employee->profile->account_number, [
                            'class' => 'form-control'
                        ]) }}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        {{ Form::label('branch_id', 'Sucursal:*') }}
                        {{ Form::select('branch_id', $branches, $employee->profile->branch_id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        {{ Form::label('department_id', 'Departamento:*') }}
                        {{ Form::select('department_id', $departments, $employee->profile->department->id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        {{ Form::label('unit_id', 'Unidad:*') }}
                        {{ Form::select('unit_id', $units, $employee->profile->unit_id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        {{ Form::label('position_id', 'Cargo:*') }}
                        {{ Form::select('position_id', $positions, $employee->profile->position->id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                        @if($errors->has('position_id'))
                            <span class="text-danger">
                                <p>{{ $errors->first('position_id') }}</p>
                            </span>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <div class="col-sm-6">
                        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>

            </form>
        </div> {{-- .card-body --}}
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