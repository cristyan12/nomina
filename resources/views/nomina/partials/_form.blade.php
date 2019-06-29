<div class="form-group row">
    <label for="name" class="col-md-2 col-form-label text-md-right">Nombre:*</label>
    <div class="col-md-10">
        <input type="text" name="name" id="name"
            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
            value="{{ old('name') }}"
        >
        @if($errors->has('name'))
            <span class="text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<hr>
<div class="form-group row">
    <label for="type" class="col-md-2 col-form-label text-md-right">Tipo*:</label>
    <br>
    <div class="col-md-10 mt-2">
        @foreach(trans('nominas.types') as $type => $name)
            <div class="form-check form-check-inline">
                <input class="form-check-input" 
                    type="radio"
                    name="type"
                    id="type_{{ $type }}"
                    value="{{ $type }}"
                     {{ old('type') == $type ? 'checked' : '' }}>
                <label class="form-check-label" for="type_{{ $type }}">{{ $name }}</label>
            </div>
        @endforeach

        @if($errors->has('type'))
            <br>
            <span class="text-danger">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>  
</div>
<hr>
<div class="form-group row">
    <label for="periods" class="col-sm-2 col-form-label text-md-right">Períodos:</label>    
    <div class="col-md-2">
        <input type="text" class="form-control" id="periods" name="periods" value="{{ old('periods') }}">
    </div>

    <label for="first_period" class="col-sm-3 col-form-label text-md-right">Fecha del primer período:</label>
    <div class="col-md-5">
        <input type="date" class="form-control" id="first_period" name="first_period" value="{{ old('first_period') }}">
    </div>
</div>
<hr>
<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-2">
        <button class="btn btn-primary">Guardar</button>
    </div>
</div>

