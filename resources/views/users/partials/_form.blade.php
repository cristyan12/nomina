<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>

    <div class="col-md-6">
        <input id="name" type="text" 
            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
            name="name" value="{{ old('name', $user->name) }}" required autofocus>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

    <div class="col-md-6">
        <input id="email" type="email" 
            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                name="email" value="{{ old('email', $user->email) }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>

    <div class="col-md-6">
        <input id="password" type="password" 
            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
        
        <small class="form-text text-muted">
            Puede dejarse en blanco en el caso que no se requiera cambiar.
        </small>

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<hr>

<div class="form-group row">
    <label for="type" class="col-md-4 col-form-label text-md-right">Lista de roles</label>
    <br>
    <div class="col-md-6 mt-2">
        @foreach($roles as $role)
            <div class="form-check ">
                <input name="roles[{{ $role->id }}]"
                    class="form-check-input" 
                    type="checkbox"
                    id="role_{{ $role->id }}"
                    value="{{ $role->id }}"
                        {{ $errors->any() ? old("roles.{$role->id}") : $user->roles->contains($role) ? 'checked' : '' }}>
                <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
            </div>
        @endforeach
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