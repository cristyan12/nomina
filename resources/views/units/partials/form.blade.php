<div class="form-group row">
    {{ Form::label('name', 'Nombre de Sucursal', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-4">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ej.: Sucursal 1']) }}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>