<h4>Datos Personales</h4>
<hr>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="code">Código:*</label>
        <input type="text"
            id="code"
            name="code"
            class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
            value="{{ old('code', $employee->code) }}"
        >
        @if($errors->has('code'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-4">
        <label for="document">Documento de identidad:*</label>
        <input type="text"
            id="document"
            name="document"
            class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}"
            value="{{ old('document', $employee->full_document) }}"
        >
        @if($errors->has('document'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('document') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-4">
        <label for="nationality">Nacionalidad:*</label>
        <select
            name="nationality"
            id="nationality"
            class="custom-select {{ $errors->has('nationality') ? 'is-invalid' : '' }}"
        >
            <option value="">Selecciona una nacionalidad</option>
            @foreach(['V' => 'Venezolana', 'E' => 'Extranjera'] as $type => $nationality)
                <option value="{{ $type }}"
                    {{ old('nationality', $employee->nationality) == $type ? 'selected' : '' }}
                >
                    {{ $nationality }}
                </option>
            @endforeach
        </select>
        @if($errors->has('nationality'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nationality') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="last_name">Apellidos:*</label>
        <input type="text"
            id="last_name"
            name="last_name"
            class="form-control{{ $errors->has('last_name') ? ' is-invalid' : ''}}"
            value="{{ old('last_name', $employee->last_name) }}"
        >
        @if($errors->has('last_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="first_name">Nombres:*</label>
        <input type="text"
            id="first_name"
            name="first_name"
            class="form-control{{ $errors->has('first_name') ? ' is-invalid' : ''}}"
            value="{{ old('first_name', $employee->first_name) }}"
        >
        @if($errors->has('first_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="rif">Registro de Información Fiscal (RIF):*</label>
        <input type="text"
            id="rif"
            name="rif"
            class="form-control{{ $errors->has('rif') ? ' is-invalid' : ''}}"
            value="{{ old('rif', $employee->rif) }}"
        >
        @if($errors->has('rif'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('rif') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-4">
        <label for="born_at">Fecha de nacimiento:*</label>
        <input type="date"
            id="born_at"
            name="born_at"
            class="form-control{{ $errors->has('born_at') ? ' is-invalid' : '' }}"
            value="{{ old('born_at', $employee->day_of_born) }}"
        >
        @if($errors->has('born_at'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('born_at') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-4">
        <label for="sex">Sexo:*</label>
        <select name="sex"
            id="sex"
            class="custom-select {{ $errors->has('sex') ? 'is-invalid' : '' }}"
        >
            <option value="">Seleccione...</option>
            @foreach(['F' => 'Femenino', 'M' => 'Masculino'] as $type => $sex)
            <option value="{{ $type }}"
                {{ old('sex', $employee->sex) == $type ? 'selected' : '' }}>{{ $sex }}</option>
            @endforeach
        </select>
        @if($errors->has('sex'))
            <span class="text-danger">
                <p>{{ $errors->first('sex') }}</p>
            </span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="civil_status">Estado Civil:*</label>
        <select name="civil_status"
            id="civil_status"
            class="custom-select {{ $errors->has('civil_status') ? 'is-invalid' : '' }}"
        >
        <option value="">Seleccione un estado civil</option>
        @foreach(trans('statuses.civil_statuses') as $type => $civilStatus)
            <option value="{{ $type }}"
                {{ old('civil_status', $employee->civil_status) == $type ? 'selected' : '' }}>
                {{ $civilStatus }}
            </option>
        @endforeach
        </select>
        @if($errors->has('civil_status'))
            <span class="text-danger">
                <p><b>{{ $errors->first('civil_status') }}</b></p>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="city_of_born">Ciudad de nacimiento:*</label>
        <input type="text"
            id="city_of_born"
            name="city_of_born"
            class="form-control{{ $errors->has('city_of_born') ? ' is-invalid' : ''}}"
            value="{{ old('city_of_born', $employee->city_of_born) }}"
        >
        @if($errors->has('city_of_born'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('city_of_born') }}</strong>
            </span>
        @endif
    </div>
</div>

<h4>Datos Laborares</h4>
<hr>

<div class="form-row">
    <div class="form-group col-md-3">
        <label for="hired_at">Fecha de contratación:*</label>
        <input type="date"
            id="hired_at"
            name="hired_at"
            class="form-control{{ $errors->has('hired_at') ? ' is-invalid' : '' }}"
            value="{{ old('hired_at', $employee->day_of_hired) }}"
        >
        @if($errors->has('hired_at'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('hired_at') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-3">
        <label for="status">Status:*</label>
        <select name="status"
            id="status"
            class="custom-select {{ $errors->has('status') ? 'is-invalid' : '' }}"
        >
            <option value="">Selecciona un status laboral</option>
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

    <div class="form-group col-md-3">
        <label for="profession_id">Profesión:*</label>
        <select name="profession_id"
            id="profession_id"
            class="custom-select{{ $errors->has('profession_id') ? ' is-invalid' : '' }}"
        >
            <option value="">Selecciona una profesión</option>
            @foreach($professions as $profession)
                <option value="{{ $profession->id }}"
                    {{ old('profession_id', $employee->profile->profession_id) == $profession->id ? ' selected' : '' }}>
                    {{ $profession->title }}
                </option>
            @endforeach
        </select>
        @if($errors->has('profession_id'))
            <span class="text-danger">
                <p>{{ $errors->first('profession_id') }}</p>
            </span>
        @endif
    </div>

    <div class="form-group col-md-3">
        <label for="contract">Tipo de contrato:*</label>
        <select name="contract"
            id="contract"
            class="custom-select{{ $errors->has('contract') ? ' is-invalid' : '' }}"
        >
            <option value="">Selecciona un tipo de contrato</option>
            @foreach(['T' => 'Temporal', 'I' => 'Indefinido'] as $type => $contract)
            <option value="{{ $type }}"
                {{ old('contract', $employee->profile->contract) == $type ? 'selected' : '' }}>
                {{ $contract }}
            </option>
            @endforeach
        </select>
        @if($errors->has('contract'))
            <span class="text-danger">
                <p>{{ $errors->first('contract') }}</p>
            </span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="bank_id">Banco:*</label>
        <select name="bank_id"
            id="bank_id"
            class="custom-select{{ $errors->has('bank_id') ? ' is-invalid' : '' }}"
        >
        <option value="">Seleccione el banco</option>
        @foreach($banks as $bank)
            <option value="{{ $bank->id }}"
                {{ old('bank_id', $employee->profile->bank_id) == $bank->id ? 'selected' : '' }}>
                {{ $bank->code }} - {{ $bank->name }}
            </option>
        @endforeach
        </select>
        @if($errors->has('bank_id'))
            <span class="text-danger">
                <p>{{ $errors->first('bank_id') }}</p>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="account_number">Número de cuenta:*</label>
        <input type="text"
            name="account_number"
            id="account_number"
            class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}"
            value="{{ old('account_number', $employee->profile->account_number) }}"
        >
        @if($errors->has('account_number'))
            <span class="text-danger">
                <p>{{ $errors->first('account_number') }}</p>
            </span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="branch_id">Sucursal:*</label>
        <select
            name="branch_id"
            id="branch_id"
            class="custom-select{{ $errors->has('branch_id') ? ' is-invalid' : ''}}"
        >
            <option value="">Seleccione una sucursal</option>
            @foreach($branches as $branch)
            <option value="{{ $branch->id }}"
                {{ old('branch_id', $employee->profile->branch_id) == $branch->id ? 'selected' : '' }}>
                {{ $branch->name }}
            </option>
            @endforeach
        </select>
        @if($errors->has('branch_id'))
            <span class="text-danger">
                <p>{{ $errors->first('branch_id') }}</p>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="department_id">Departamento:*</label>
        <select
            name="department_id"
            id="department_id"
            class="custom-select{{ $errors->has('department_id') ? ' is-invalid' : ''}}"
        >
            <option value="">Seleccione un departamento</option>
            @foreach($departments as $department)
            <option value="{{ $department->id }}"
                {{ old('department_id', $employee->profile->department_id) == $department->id ? 'selected' : '' }}>
                {{ $department->name }}
            </option>
            @endforeach
        </select>
        @if($errors->has('department_id'))
            <span class="text-danger">
                <p>{{ $errors->first('department_id') }}</p>
            </span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="unit_id">Unidad:*</label>
        <select
            name="unit_id"
            id="unit_id"
            class="custom-select{{ $errors->has('unit_id') ? ' is-invalid' : ''}}"
        >
            <option value="">Seleccione una sucursal</option>
            @foreach($units as $unit)
            <option value="{{ $unit->id }}"
                {{ old('unit_id', $employee->profile->unit_id) == $unit->id ? 'selected' : '' }}>
                {{ $unit->name }}
            </option>
            @endforeach
        </select>
        @if($errors->has('unit_id'))
            <span class="text-danger">
                <p>{{ $errors->first('unit_id') }}</p>
            </span>
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="position_id">Cargo:*</label>
        <select
            name="position_id"
            id="position_id"
            class="custom-select{{ $errors->has('position_id') ? ' is-invalid' : ''}}"
        >
            <option value="">Seleccione una sucursal</option>
            @foreach($positions as $position)
            <option value="{{ $position->id }}"
                {{ old('position_id', $employee->profile->position_id) == $position->id ? 'selected' : '' }}>
                {{ $position->name }}
            </option>
            @endforeach
        </select>
        @if($errors->has('position_id'))
            <span class="text-danger">
                <p>{{ $errors->first('position_id') }}</p>
            </span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col">
        <label for="nomina_id">Nómina:*</label>
        <select
            name="nomina_id"
            id="nomina_id"
            class="custom-select{{ $errors->has('nomina_id') ? ' is-invalid' : ''}}"
        >
            <option value="">Seleccione una sucursal</option>
            @foreach($nominas as $nomina)
            <option value="{{ $nomina->id }}"
                {{ old('nomina_id', $employee->nomina_id) == $nomina->id ? 'selected' : '' }}>
                {{ $nomina->name }}
            </option>
            @endforeach
        </select>
        @if($errors->has('nomina_id'))
            <span class="text-danger">
                <p>{{ $errors->first('nomina_id') }}</p>
            </span>
        @endif
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</div>