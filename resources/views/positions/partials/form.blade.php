

<div class="form-group row">
    {{ Form::label('code', 'Código SISDEM', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-4">
        {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Ej.: OOPEOO']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('name', 'Cargo', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-9">
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ej.: Juan Perez']) }}
    </div>
</div>

<div class="form-group row">
    {{ Form::label('basic_salary', 'Salario Básico', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-9">
        {{ Form::text('basic_salary', null, ['class' => 'form-control', 'placeholder' => 'Ej.: 123456.23']) }}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
    {{ Form::submit('Crear Cargo', ['class' => 'btn btn-primary']) }}
    </div>
</div>

