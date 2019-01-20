<div class="form-group row">
    {{ Form::label('type', 'Tipo:', ['class' => 'col-sm-3 col-form-label']) }}

    <div class="col-md-4">
<<<<<<< HEAD
        {{ Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Tipo del contrato']) }}
    </div>
=======
        {{ Form::select('type', [
            'INDEFINIDO' => 'Indefinido',
            'TEMPORAL' => 'Temporal'
        ], null, [
            'class' => 'custom-select',
            'placeholder' => 'Tipo de contrato'
        ]) }}
    </div>

    {{-- <div class="col-md-4">
        <select class="custom-select">
            <option selected>Tipo de contrato:</option>
            <option value="INDEFINIDO">Indefinido</option>
            <option value="TEMPORAL">Temporal</option>
        </select>
    </div> --}}
>>>>>>> dev
</div>

<div class="form-group row">
    {{ Form::label('duration', 'Duración:', ['class' => 'col-sm-3 col-form-label']) }}

<<<<<<< HEAD
    <div class="col-md-9">
        {{ Form::text('duration', null, ['class' => 'form-control', 'placeholder' => 'Duración del contrato']) }}
=======
    <div class="col-md-4">
        {{ Form::text('duration', null, ['class' => 'form-control', 'placeholder' => 'Duración']) }}
>>>>>>> dev
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-sm-6">
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary']) }}
    </div>
</div>