<div class="form-group">
    <label for="name">Nombre:*</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}">
</div>
<div class="form-group">
    <label for="slug">URL Amigable:*</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $permission->slug) }}">
</div>
<div class="form-group">
    <label for="description">Descripción:*</label>
    <textarea name="description" class="form-control">{{ old('description', $permission->description) }}</textarea>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
</div>
