<div class="form-group row">
    {{ Form::label('name', 'Departamento:*', ['class' => 'col-md-4 col-form-label text-md-right']) }}

    <div class="col-md-6">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        
        @if($errors->has('name'))
            <span class="text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<hr>

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>