<div class="form-group row">
    <label for="title" class="col-md-4 col-form-label text-md-right">Título de la profesión:*</label>

    <div class="col-md-6">
        <input type="text" name="title" class="form-control" value="{{ old('title', $profession->title) }}">

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
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</div>
