<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Banco:*</label>

    <div class="col-md-6">
        <select name="bank_id" class="custom-select">
            <option></option>
            @foreach($banks as $bank)
                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
            @endforeach
        </select>

        @if ($errors->has('bank_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('bank_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Número de cuenta:*</label>

    <div class="col-md-6">
        <input type="text" name="number" class="form-control" value="{{ old('number', $account->number) }}">

        @if ($errors->has('number'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('number') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Tipo de cuenta:</label>

    <div class="col-md-6">
        <select name="type" class="custom-select">
            <option></option>
            <option value="Corriente">Corriente</option>
            <option value="Ahorro">Ahorro</option>
        </select>

        @if ($errors->has('type'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Primer autorizado:*</label>

    <div class="col-md-6">
        <select name="auth_1" class="custom-select">
            <option></option>
            @foreach($auth1 as $firstAuth)
                <option value="{{ $firstAuth->id }}">{{ $firstAuth->full_name }}</option>
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
                <option value="{{ $secondAuth->id }}">{{ $secondAuth->full_name }}</option>
            @endforeach
        </select>

        @if ($errors->has('auth_2'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('auth_2') }}</strong>
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