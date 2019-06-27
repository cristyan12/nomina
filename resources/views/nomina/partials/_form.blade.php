<div class="form-group">
    <label for="name">Nombre:*</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
</div>
<div class="form-group">
    <label for="type">Tipo*:</label>
    <br>
    <label>
        <input type="radio" name="type" id="type" value="Semanal"> Semanal
    </label>
    <label>
        <input type="radio" name="type" id="type" value="Quincenal"> Quincenal
    </label>
    <label>
        <input type="radio" name="type" id="type" value="Quincenal"> Quincenal
    </label>
    <label>
        <input type="radio" name="type" id="type" value="Mensual"> Mensual
    </label>
    <label>
        <input type="radio" name="type" id="type" value="Otros"> Otros
    </label>
</div>
<div class="form-group">
    <label for="periods">Periodos:</label>
    <input type="text" name="periods" id="periods" class="form-control col-sm-2" value="{{ old('periods') }}">
</div>
<div class="form-group">
    <label for="first_period_at">Fecha del primer período:</label>
    <input type="date" name="first_period_at" id="first_period_at" class="form-control col-sm-4" value="{{ old('first_period_at') }}">
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        Guardar
    </button>
</div>