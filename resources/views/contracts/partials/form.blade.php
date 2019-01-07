<div class="form-group row">
    {{ Form::label('type', 'Tipo:', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-4">
        {{ Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Tipo del contrato']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('duration', 'Duración:', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-9">
        {{ Form::text('duration', null, ['class' => 'form-control', 'placeholder' => 'Duración del contrato']) }}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>