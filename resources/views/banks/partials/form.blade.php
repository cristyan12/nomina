<div class="form-row">
	<div class="form-group col-md-3">
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

	<div class="form-group col-md-9">
		<label for="name">Nombre:*</label>
		<input type="text" id="name" name="name"
			class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}" value="{{ old('name') }}"
		>
	    @if($errors->has('name'))
	    	<span class="invalid-feedback" role="alert">
	    		<strong>{{ $errors->first('name') }}</strong>
	    	</span>
	    @endif
	</div>
</div>

<div class="form-row">
	<div class="form-group col-md-6">
		<label for="account">Número de cuenta:*</label>
		<input type="text" id="account" name="account"
			class="form-control{{ $errors->has('account') ? ' is-invalid' : ''}}" value="{{ old('account') }}"
		>
	    @if($errors->has('account'))
	    	<span class="invalid-feedback" role="alert">
	    		<strong>{{ $errors->first('account') }}</strong>
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