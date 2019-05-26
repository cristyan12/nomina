<div class="form-group row">
    {{ Form::label('name', 'Nombre de la Unidad', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>

<hr>

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>