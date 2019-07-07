<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>

    <div class="col-md-6">
        <input id="name" type="text" name="name" 
            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
            value="{{ old('name', $company->name) }}" required
        >

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="rif" class="col-md-4 col-form-label text-md-right">RIF:</label>

    <div class="col-md-6">
        <input id="rif" type="text" name="rif" 
            class="form-control{{ $errors->has('rif') ? ' is-invalid' : '' }}" 
            value="{{ old('rif', $company->rif) }}" required
        >

        @if ($errors->has('rif'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('rif') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="address" class="col-md-4 col-form-label text-md-right">Dirección:</label>

    <div class="col-md-6">
        <textarea name="address" class="form-control" id="address" cols="30" rows="10">
            {{ old('address', $company->address) }}
        </textarea>

        @if ($errors->has('address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Teléfono:</label>

    <div class="col-md-6">
        <input id="phone_number" type="text" name="phone_number" 
            class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" 
            value="{{ old('phone_number', $company->phone_number) }}" required
        >

        @if ($errors->has('phone_number'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone_number') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Correo:</label>

    <div class="col-md-6">
        <input id="email" type="text" name="email" 
            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
            value="{{ old('email', $company->email) }}" required
        >

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="city" class="col-md-4 col-form-label text-md-right">Ciudad:</label>

    <div class="col-md-6">
        <input id="city" type="text" name="city" 
            class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" 
            value="{{ old('city', $company->city) }}" required
        >

        @if ($errors->has('city'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('city') }}</strong>
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