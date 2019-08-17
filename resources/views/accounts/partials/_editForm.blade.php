<div class="form-group row">
<label for="bank_id" class="col-md-4 col-form-label text-md-right">Banco:*</label>

<div class="col-md-6">
    <select name="bank_id" id="bank_id" class="custom-select" disabled>
        <option></option>
        @foreach($banks as $bank)
        <option 
            value="{{ $bank->id }}"{{ old('bank_id', $account->bank_id) == $bank->id ? ' selected' : '' }}>{{ $bank->name }}
        </option>
        @endforeach
    </select>
</div>
</div>

<div class="form-group row">
<label for="name" class="col-md-4 col-form-label text-md-right">Número de cuenta:*</label>

<div class="col-md-6">
    <input type="text" name="number" 
    class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" 
    value="{{ old('number', $account->number) }}" disabled>
</div>
</div>

<div class="form-group row">
<label for="name" class="col-md-4 col-form-label text-md-right">Tipo de cuenta:</label>

<div class="col-md-6">
    <select name="type" class="custom-select" disabled>
        <option value="Corriente">Corriente</option>
        <option value="Ahorro">Ahorro</option>
    </select>
</div>
</div>


<div class="form-group row">
<label for="name" class="col-md-4 col-form-label text-md-right">Primer autorizado:*</label>

<div class="col-md-6">
    <select name="auth_1" class="custom-select{{ $errors->has('auth_1') ? ' is-invalid' : '' }}">
        <option></option>
        @foreach($auth1 as $firstAuth)
            <option 
                value="{{ $firstAuth->id }}"{{ old('auth_1', $account->auth_1) == $firstAuth->id ? ' selected' : '' }}>
                {{ $firstAuth->full_name }}
            </option>
        @endforeach
    </select>

    @if ($errors->has('auth_1'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('auth_1') }}</strong>
        </span>
    @endif
</div>
</div>

<div class="form-group row">
<label for="name" class="col-md-4 col-form-label text-md-right">Segundo autorizado:</label>

<div class="col-md-6">
    <select name="auth_2" class="custom-select">
        <option></option>
        @foreach($auth2 as $secondAuth)
            <option 
                value="{{ $secondAuth->id }}"{{ old('auth_2', $account->auth_2) == $secondAuth->id ? ' selected' : '' }}>
                {{ $secondAuth->full_name }}
            </option>
        @endforeach
    </select>
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
