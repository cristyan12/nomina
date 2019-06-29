<div class="form-group row">
    <label for="name" class="col-md-2 col-form-label text-md-right">
        Nombre:*
    </label>

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
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="type" value="Semanal">
            <label class="form-check-label" for="type">Semanal</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="type" value="Quincenal">
            <label class="form-check-label" for="type">Quincenal</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="type" value="Mensual">
            <label class="form-check-label" for="type">Mensual</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="type" value="Otros">
            <label class="form-check-label" for="type">Otros</label>
        </div>

        @if($errors->has('type'))
            <br>
            <span class="text-danger">
                <strong>{{ $errors->first('type') }}</strong>
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

