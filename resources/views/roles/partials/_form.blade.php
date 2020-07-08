<div class="form-group">
    <label for="name">Nombre:*</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
</div>
<div class="form-group">
    <label for="slug">URL Amigable:*</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $role->slug) }}">
</div>
<div class="form-group">
    <label for="description">Descripción:*</label>
    <textarea
        name="description"
        id="description"
        class="form-control"
    >{{ old('description', $role->description) }}</textarea>
</div>
<hr>
<h3 class="lead font-weight-bold">Permiso especial</h3>
<div class="form-group">
    <label>
        <input type="radio"
            name="special"
            value="all-access"
            {{ old('special', $role->special) == 'all-access' ? 'checked' : '' }}
        > Acceso Total
    </label>
    <label>
        <input type="radio"
            name="special"
            value="no-access"
            {{ old('special', $role->special) == 'no-access' ? 'checked' : '' }}
        > Ningún Acceso
    </label>
</div>
<hr>
<h3 class="lead font-weight-bold">Lista de permisos</h3>
<div class="form-group">
    <ul class="list-unstyled">
    @foreach($permissions as $permission)
        <li>
            <label>
                <input type="checkbox"
                    name="permissions[{{ $permission->id }}]"
                    id="type_{{ $permission->id }}"
                    value="{{ $permission->id }}"
                    {{ $errors->any() ? old("permissions.{$permission->id}") : $role->permissions->contains($permission) ? 'checked' : '' }}
                >
                {{ $permission->name }}
                <em class="text-muted">({{ $permission->description ?: 'Sin Descripción' }})</em>
            </label>
        </li>
    @endforeach
    </ul>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
</div>
