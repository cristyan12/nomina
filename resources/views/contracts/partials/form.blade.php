<div class="form-group row">
    {{ Form::label('type', 'Tipo del contrato:', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-4">
        {{ Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Temporal']) }}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>