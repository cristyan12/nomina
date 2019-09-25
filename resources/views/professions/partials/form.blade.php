<div class="form-group row">
    {{ Form::label('title', 'Título de la profesión:*', ['class' => 'col-md-4 col-form-label text-md-right']) }}

    <div class="col-md-6">
        {{ Form::text('title', null, ['class' => 'form-control']) }}
        
        @if($errors->has('title'))
            <span class="text-danger">
                <strong>{{ $errors->first('title') }}</strong>
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