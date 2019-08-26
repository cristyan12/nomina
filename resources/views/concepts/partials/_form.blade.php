<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre*:</label>

    <div class="col-md-6">
        <input id="name" type="text" name="name" 
            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
            value="{{ old('name', $concept->name) }}" 
        >

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="type" class="col-md-4 col-form-label text-md-right">Tipo*:</label>

    <div class="col-md-6 mt-2">
        @foreach(trans('concepts.types') as $type => $name)
            <div class="form-check form-check-inline">
                <input class="form-check-input"
                    type="radio"
                    name="type"
                    id="type_{{ $type }}"
                    value={{ $type }}
                        {{ old('type', $concept->type) == $type ? 'checked' : '' }}>
                <label class="form-check-label" for="type_{{ $type }}">{{ $name }}</label>
            </div>
        @endforeach

        @if ($errors->has('type'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">Descripción*:</label>

    <div class="col-md-6">
        <textarea name="description" class="form-control">{{ old('description', $concept->description) }}</textarea>

        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="quantity" class="col-md-4 col-form-label text-md-right">Cantidad*:</label>

    <div class="col-md-6">
        <input id="quantity" type="text" name="quantity" 
            class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
            value="{{ old('quantity', $concept->quantity) }}">

        @if ($errors->has('quantity'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="calculation_salary" class="col-md-4 col-form-label text-md-right">Salario del cálculo*:</label>

    <div class="col-md-6">
        <input id="calculation_salary" type="text" name="calculation_salary" 
            class="form-control{{ $errors->has('calculation_salary') ? ' is-invalid' : '' }}" 
            value="{{ old('calculation_salary', $concept->calculation_salary) }}"
        >
        <small class="text-muted">Posiblemente se deban tomar los datos que arroje una consulta a la BD</small>

        @if ($errors->has('calculation_salary'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('calculation_salary') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="formula" class="col-md-4 col-form-label text-md-right">Formula*:</label>

    <div class="col-md-6">
        <textarea 
            name="formula" 
            class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
        >{{ old('formula', $concept->formula) }}</textarea>

        @if ($errors->has('formula'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('formula') }}</strong>
            </span>
        @endif
    </div>
</div>

<hr>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</div>