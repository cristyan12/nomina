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
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
</div>
