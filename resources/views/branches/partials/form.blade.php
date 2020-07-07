<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de Sucursal:*</label>
    <div class="col-md-6">
        <input type="text" name="name" class="form-control" value="{{ old('name', $branch->name) }}">
        @if($errors->has('name'))
            <span class="text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<hr>
<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </div>
</div>