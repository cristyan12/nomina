<div class="form-group row">
    {{ Form::label('title', 'Título de la profesión:', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-4">
        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ej.: Ingeniero']) }}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>