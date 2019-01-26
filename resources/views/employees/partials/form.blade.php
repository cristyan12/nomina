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
	    {{ Form::select('nationality', ['V' => 'Venezolana', 'E' => 'Extranjera'], null, ['class' => 'custom-select']) }}
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
	    {{ Form::label('last_name', 'Apellidos:*') }}
	    {{ Form::text('last_name', null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group col-md-6">
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
	    	'Casado/a', 'Soltero/a', 'Viudo/a'], null, [
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
	    {{ Form::select('profession_id', $professions, null, ['class' => 'custom-select']) }}
	</div>

	<div class="form-group col-md-6">
		{{ Form::label('contract_id', 'Tipo de contrato:*') }}
	    {{ Form::select('contract_id', ['T' => 'Temporal', 'I' => 'Indefinido'], null, ['class' => 'custom-select']) }}
	</div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>