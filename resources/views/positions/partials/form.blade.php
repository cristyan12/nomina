<div class="form-group row">
    <label for="code" class="col-md-4 col-form-label text-md-right">Código SISDEM:*</label>

    <div class="col-md-6">
        <input type="text"
            name="code"
            class="form-control"
            value="{{ old('code', $position->code) }}"
        >
        @if($errors->has('code'))
            <span class="text-danger">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Cargo:*</label>

    <div class="col-md-6">
        <input type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $position->name) }}"
        >
        @if($errors->has('name'))
            <span class="text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="basic_salary" class="col-md-4 col-form-label text-md-right">Salario Básico:*</label>

    <div class="col-md-6">
        <input type="text"
            name="basic_salary"
            class="form-control"
            value="{{ old('basic_salary', $position->basic_salary) }}"
        >
        <small class="form-text text-muted">Si lo amerita, utilice el separador decimal punto (.)</small>
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
        <button class="btn btn-primary" type="submit">Guardar</button>
    </div>
</div>

