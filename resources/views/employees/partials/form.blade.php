<div class="form-row">
	<div class="form-group col-md-4">
		<label for="code">Código:*</label>
		<input type="text" id="code" name="code"
			class="form-control{{ $errors->has('code') ? ' is-invalid' : ''}}" value="{{ old('code') }}"
		>
	    @if($errors->has('code'))
	    	<span class="invalid-feedback" role="alert">
	    		<strong>{{ $errors->first('code') }}</strong>
	    	</span>
	    @endif
	</div>

	<div class="form-group col-md-4">
	    <label for="document">Documento de identidad:*</label>
		<input type="text" id="document" name="document"
			class="form-control{{ $errors->has('document') ? ' is-invalid' : ''}}" value="{{ old('document') }}"
		>
	    @if($errors->has('document'))
	    	<span class="invalid-feedback" role="alert">
	    		<strong>{{ $errors->first('document') }}</strong>
	    	</span>
	    @endif
	</div>

	<div class="form-group col-md-4">
	    {{ Form::label('nationality', 'Nacionalidad:*') }}
	    {{ Form::select('nationality', ['V' => 'Venezolana', 'E' => 'Extranjera'], null, [
	    	'class' => 'custom-select'
	    ]) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col">
	    <label for="last_name">Apellidos:*</label>
		<input type="text" id="last_name" name="last_name"
			class="form-control{{ $errors->has('last_name') ? ' is-invalid' : ''}}" value="{{ old('last_name') }}"
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
			class="form-control{{ $errors->has('first_name') ? ' is-invalid' : ''}}" value="{{ old('first_name') }}"
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
			class="form-control{{ $errors->has('rif') ? ' is-invalid' : ''}}" value="{{ old('rif') }}"
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
	    	class="form-control{{ $errors->has('born_at') ? ' is-invalid' : '' }}" value="{{ old('born_at') }}"
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
	    {{ Form::label('marital_status', 'Estado Civil:*') }}
	    {{ Form::select('marital_status', [
	    	'Soltero/a' => 'Soltero/a',
	    	'Casado/a' => 'Casado/a',
	    	'Viudo/a' => 'Viudo/a'
	    ], null, ['class' => 'custom-select']) }}
	</div>

	<div class="form-group col-md-6">
	    {{ Form::label('sex', 'Sexo:*') }}
	    {{ Form::select('sex', ['M' => 'Masculino', 'F' => 'Femenino'], null, [
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
	<div class="form-group col-md-6">
	    <label for="city_of_born">Ciudad de nacimiento:*</label>
		<input type="text" id="city_of_born" name="city_of_born"
			class="form-control{{ $errors->has('city_of_born') ? ' is-invalid' : ''}}" value="{{ old('city_of_born') }}"
		>
	    @if($errors->has('city_of_born'))
	    	<span class="invalid-feedback" role="alert">
	    		<strong>{{ $errors->first('city_of_born') }}</strong>
	    	</span>
	    @endif
	</div>

	<div class="form-group col-md-6">
	    <label for="hired_at">Fecha de contratación:*</label>
	    <input type="date" id="hired_at" name="hired_at"
	    	class="form-control{{ $errors->has('hired_at') ? ' is-invalid' : '' }}" value="{{ old('hired_at') }}"
	    >
	    @if($errors->has('hired_at'))
	    	<span class="invalid-feedback" role="alert">
	    		<strong>{{ $errors->first('hired_at') }}</strong>
	    	</span>
	    @endif
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
	    {{ Form::label('profession_id', 'Profesión:*') }}
	    {{ Form::select('profession_id', $professions, null, [
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
	    {{ Form::select('contract', ['T' => 'Temporal', 'I' => 'Indefinido'], null, [
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
	    {{ Form::select('bank_id', $banks, null, [
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
		{{ Form::label('account_number', 'Número de cuenta:*') }}
		{{ Form::text('account_number', null, [
			'class' => 'form-control'
		]) }}
	    @if($errors->has('account_number'))
	    	<span class="text-danger">
	    		<p>{{ $errors->first('account_number') }}</p>
	    	</span>
	    @endif
	</div>
</div>

<div class="form-row">
	<div class="form-group col">
	    {{ Form::label('branch_id', 'Sucursal:*') }}
	    {{ Form::select('branch_id', $branches, null, [
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
	    {{ Form::select('department_id', $departments, null, [
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
	    {{ Form::select('unit_id', $units, null, [
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
	    {{ Form::select('position_id', $positions, null, [
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