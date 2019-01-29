<div class="form-row">
	<div class="form-group col-md-4">
	    {{ Form::label('code', 'Código:*') }}
	    {{ Form::text('code', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group col-md-4">
	    {{ Form::label('document', 'Documento de identidad:*') }}
	    {{ Form::text('document', null, ['class' => 'form-control']) }}
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
	    {{ Form::label('last_name', 'Apellidos:*') }}
	    {{ Form::text('last_name', null, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col">
	    {{ Form::label('first_name', 'Nombres:*') }}
	    {{ Form::text('first_name', null, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
	    {{ Form::label('rif', 'Registro de Información Fiscal (RIF):*') }}
	    {{ Form::text('rif', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group col-md-6">
	    {{ Form::label('born_at', 'Fecha de nacimiento:*') }}
	    {{ Form::date('born_at', null, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
	    {{ Form::label('marital_status', 'Estado Civil:*') }}
	    {{ Form::select('marital_status', [
	    	'Casado/a' => 'Casado/a',
	    	'Soltero/a' => 'Soltero/a',
	    	'Viudo/a' => 'Viudo/a'
	    ], 
	    null, 
	    [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>

	<div class="form-group col-md-6">
	    {{ Form::label('sex', 'Sexo:*') }}
	    {{ Form::select('sex', ['M' => 'Masculino', 'F' => 'Femenino'], null, [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
	    {{ Form::label('city_of_born', 'Ciudad de nacimiento:*') }}
	    {{ Form::text('city_of_born', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group col-md-6">
	    {{ Form::label('hired_at', 'Fecha de contratación:*') }}
	    {{ Form::date('hired_at', null, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
	    {{ Form::label('profession_id', 'Profesión:*') }}
	    {{ Form::select('profession_id', $professions, null, [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>

	<div class="form-group col-md-6">
		{{ Form::label('contract', 'Tipo de contrato:*') }}
	    {{ Form::select('contract', ['T' => 'Temporal', 'I' => 'Indefinido'], null, [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
	    {{ Form::label('bank_pay_id', 'Banco:*') }}
	    {{ Form::select('bank_pay_id', $bankOfPays, null, [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>

	<div class="form-group col-md-6">
		{{ Form::label('account_number', 'Número de cuenta:*') }}
		{{ Form::text('account_number', null, [
			'class' => 'form-control'
		]) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col">
	    {{ Form::label('branch_id', 'Sucursal:*') }}
	    {{ Form::select('branch_id', $branches, null, [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col">
	    {{ Form::label('department_id', 'Departamento:*') }}
	    {{ Form::select('department_id', $departments, null, [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col">
	    {{ Form::label('unit_id', 'Unidad:*') }}
	    {{ Form::select('unit_id', $units, null, [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col">
	    {{ Form::label('position_id', 'Cargo:*') }}
	    {{ Form::select('position_id', $positions, null, [
	    	'class' => 'custom-select',
	    	'placeholder' => 'Seleccione una opción:'
	    ]) }}
	</div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>