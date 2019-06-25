<div class="form-group">
    <label for="name">Nombre:*</label>
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="slug">URL Amigable:*</label>
    {{ Form::text('slug', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="description">Descripción:*</label>
    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) }}
</div>
<hr>
<h3 class="lead font-weight-bold">Permiso especial</h3>
<div class="form-group">
    <label>{{ Form::radio('special', 'all-access') }} Acceso Total</label>
    <label>{{ Form::radio('special', 'no-access') }} Ningún acceso</label>
</div>
<hr>
<h3 class="lead font-weight-bold">Lista de permisos</h3>
<div class="form-group">
    <ul class="list-unstyled">
    @foreach($permissions as $permission)
        <li>
            <label>
                {{ Form::checkbox('permissions[]', $permission->id, null) }}
                {{ $permission->name }}
                <em class="text-muted">({{ $permission->description ?: 'Sin Descripción' }})</em>
            </label>
        </li>
    @endforeach
    </ul>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
</div>
