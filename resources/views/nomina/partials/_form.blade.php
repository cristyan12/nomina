<div class="form-group row">
    <label for="name" class="col-md-2 col-form-label text-md-right">Nombre:*</label>
    <div class="col-md-10">
        <input type="text" name="name" id="name"
            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
            value="{{ old('name', $nomina->name) }}"
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
                     {{ old('type', $nomina->type) == $type ? 'checked' : '' }}>
                <label class="form-check-label" for="type_{{ $type }}">{{ $name }}</label>
            </div>
        @endforeach

        @if($errors->has('type'))
            <br>
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>  
</div>
<hr>
<div class="form-group row">
    <label for="periods" class="col-sm-2 col-form-label text-md-right">Períodos:</label>    
    <div class="col-md-2">
        <input type="text" 
            class="form-control" 
            id="periods" 
            name="periods" 
            value="{{ old('periods', $nomina->periods) }}"
        >
    </div>

    <label for="first_period_at" class="col-sm-3 col-form-label text-md-right">Fecha del primer período:</label>
    <div class="col-md-5">
        <input type="date" 
            id="first_period_at" 
            name="first_period_at" 
            class="form-control{{ $errors->has('first_period_at') ? ' is-invalid' : '' }}" 
            value="{{ old('first_period_at', $nomina->first_date_period) }}"
        >
        @if($errors->has('first_period_at'))
            <span class="text-danger">
                <strong>{{ $errors->first('first_period_at') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4"></div>
    
    <label for="last_period_at" class="col-sm-3 col-form-label text-md-right">Fecha del último período:</label>
    <div class="col-md-5">
        <input type="date" 
            id="last_period_at" 
            name="last_period_at" 
            class="form-control{{ $errors->has('last_period_at') ? ' is-invalid' : '' }}" 
            value="{{ old('last_period_at', $nomina->last_period_at) }}"
        >
        @if($errors->has('last_period_at'))
            <span class="text-danger">
                <strong>{{ $errors->first('last_period_at') }}</strong>
            </span>
        @endif
    </div>
</div>
<hr>
<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-2">
        <button class="btn btn-primary">Guardar</button>
    </div>
</div>

