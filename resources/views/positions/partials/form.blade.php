<div class="form-group row text-right">
    {{ Form::label('code', 'Código SISDEM', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-4">
        {{ Form::text('code', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row text-right">
    {{ Form::label('name', 'Cargo', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-9">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group row text-right">
    {{ Form::label('basic_salary', 'Salario Básico', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-9">
        {{ Form::text('basic_salary', null, ['class' => 'form-control']) }}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
    {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>

