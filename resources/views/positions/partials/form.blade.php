<div class="form-group row">
    {{ Form::label('code', 'Código SISDEM:*', ['class' => 'col-md-4 col-form-label text-md-right']) }}

    <div class="col-md-6">
        {{ Form::text('code', null, ['class' => 'form-control']) }}

        @if($errors->has('code'))
            <span class="text-danger">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('name', 'Cargo:*', ['class' => 'col-md-4 col-form-label text-md-right']) }}

    <div class="col-md-6">
        {{ Form::text('name', null, ['class' => 'form-control']) }}

        @if($errors->has('name'))
            <span class="text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('basic_salary', 'Salario Básico:*', ['class' => 'col-md-4 col-form-label text-md-right']) }}

    <div class="col-md-6">
        {{ Form::text('basic_salary', null, ['class' => 'form-control']) }}

        @if($errors->has('basic_salary'))
            <span class="text-danger">
                <strong>{{ $errors->first('basic_salary') }}</strong>
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

