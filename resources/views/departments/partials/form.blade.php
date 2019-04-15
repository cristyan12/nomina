<div class="form-group row">
    {{ Form::label('name', 'Departamento', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        @if($errors->has('name'))
            <span class="text-danger">
                <strong>{{ $errors->first('name') }}</strong>
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