@extends('layouts.master')

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
                        <input type="text" id="code" name="code"
                            class="form-control{{ $errors->has('code') ? ' is-invalid' : ''}}"
                            value="{{ $employee->code }}"
                        >
                        @if($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="document">Documento de identidad:*</label>
                        <input type="text" name="document" id="document"
                            class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}"
                            value="{{ $employee->document }}"
                        >
                        @if($errors->has('document'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('document') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nationality">Nacionalidad:</label>
                        {{ Form::select('nationality', ['V' => 'Venezolana', 'E' => 'Extranjera'],
                            null,
                            ['class' => 'custom-select' ]
                        ) }}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="last_name">Apellidos:*</label>
                        <input type="text" id="last_name" name="last_name"
                            class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                            value="{{ $employee->last_name }}"
                        >
                        @if($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        <label for="first_name">Nombres:*</label>
                        <input type="text" id="first_name" name="first_name"
                            class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                            value="{{ $employee->first_name }}"
                        >
                        @if($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rif">Registro de Información Fiscal (RIF):*</label>
                        <input type="text" id="rif" name="rif"
                            class="form-control{{ $errors->has('rif') ? ' is-invalid' : '' }}"
                            value="{{ $employee->rif }}"
                        >
                        @if($errors->has('rif'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('rif') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="born_at">Fecha de nacimiento:*</label>
                        <input type="date" id="born_at" name="born_at"
                            class="form-control{{ $errors->has('born_at') ? ' is-invalid' : '' }}"
                            value="{{ $employee->born_at->format('Y-m-d') }}"
                        >
                        @if($errors->has('born_at'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('born_at') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                	<div class="form-group col-md-6">
					    {{ Form::label('civil_status', 'Estado Civil:*') }}
					    {{ Form::select('civil_status', [
					    	'Casado/a' => 'Casado/a',
					    	'Soltero/a' => 'Soltero/a',
                            'Divorciado/a' => 'Divorciado/a',
					    	'Viudo/a' => 'Viudo/a'
					    ], $employee->civil_status, ['class' => 'custom-select']) }}
					</div>

					<div class="form-group col-md-6">
					    {{ Form::label('sex', 'Sexo:*') }}
					    {{ Form::select('sex', ['M' => 'Masculino', 'F' => 'Femenino'], $employee->sex, [
					    	'class' => 'custom-select',
					    	'placeholder' => 'Seleccione una opción:'
					    ]) }}
                        @if($errors->has('sex'))
                            <span class="text-danger">
                                <p>{{ $errors->first('sex') }}</p>
                            </span>
                        @endif
                	</div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="city_of_born">Ciudad de nacimiento:*</label>
                        <input type="text" id="city_of_born" name="city_of_born"
                            class="form-control{{ $errors->has('city_of_born') ? ' is-invalid' : '' }}"
                            value="{{ $employee->city_of_born }}"
                        >
                        @if($errors->has('city_of_born'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('city_of_born') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="hired_at">Fecha de contratación:*</label>
                        <input type="date" id="hired_at" name="hired_at"
                            class="form-control{{ $errors->has('hired_at') ? ' is-invalid' : '' }}"
                            value="{{ $employee->hired_at->format('Y-m-d') }}"
                        >
                        @if($errors->has('hired_at'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hired_at') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                    <label for="status">Status:*</label>
                    <select name="status" id="status" class="custom-select">
                        @foreach(trans('statuses.status') as $type => $status)
                            <option value="{{ $type }}"
                                {{ old('status', $employee->profile->status) == $status ? ' selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>

                    @if($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>
                </div>

                <div class="form-row">
					<div class="form-group col-md-6">
					    {{ Form::label('profession_id', 'Profesión:*') }}
					    {{ Form::select('profession_id', $professions, $employee->profile->profession_id, [
					    	'class' => 'custom-select',
					    	'placeholder' => 'Seleccione una opción:'
					    ]) }}
                        @if($errors->has('profession_id'))
                            <span class="text-danger">
                                <p>{{ $errors->first('profession_id') }}</p>
                            </span>
                        @endif
					</div>

					<div class="form-group col-md-6">
						{{ Form::label('contract', 'Tipo de contrato:*') }}
					    {{ Form::select('contract', ['T' => 'Temporal', 'I' => 'Indefinido'], $employee->profile->contract, [
					    	'class' => 'custom-select',
					    	'placeholder' => 'Seleccione una opción:'
					    ]) }}
                        @if($errors->has('contract'))
                            <span class="text-danger">
                                <p>{{ $errors->first('contract') }}</p>
                            </span>
                        @endif
					</div>
				</div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('bank_id', 'Banco:*') }}
                        {{ Form::select('bank_id', $banks, $employee->profile->bank_id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                        @if($errors->has('bank_id'))
                            <span class="text-danger">
                                <p>{{ $errors->first('bank_id') }}</p>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="account_number">Número de cuenta:*</label>
                        <input type="text" id="account_number" name="account_number"
                            class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}"
                            value="{{ $employee->profile->account_number }}"
                        >
                        @if($errors->has('account_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('account_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        {{ Form::label('branch_id', 'Sucursal:*') }}
                        {{ Form::select('branch_id', $branches, $employee->profile->branch_id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                        @if($errors->has('branch_id'))
                            <span class="text-danger">
                                <p>{{ $errors->first('branch_id') }}</p>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        {{ Form::label('department_id', 'Departamento:*') }}
                        {{ Form::select('department_id', $departments, $employee->profile->department->id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                        @if($errors->has('department_id'))
                            <span class="text-danger">
                                <p>{{ $errors->first('department_id') }}</p>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col">
                        {{ Form::label('unit_id', 'Unidad:*') }}
                        {{ Form::select('unit_id', $units, $employee->profile->unit_id, [
                            'class' => 'custom-select',
                            'placeholder' => 'Seleccione una opción:'
                        ]) }}
                        @if($errors->has('unit_id'))
                            <span class="text-danger">
                                <p>{{ $errors->first('unit_id') }}</p>
                            </span>
                        @endif
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
        @can('employees.index')
            @component('layouts.components._card_footer')
                {{ route('employees.index') }}
            @endcomponent
        @endcan
    </div>
</div>
@endsection