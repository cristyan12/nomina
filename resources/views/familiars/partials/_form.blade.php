<div class="form-group row">
    <label for="employee_id" class="col-md-2 col-form-label text-md-right">ID del empleado:</label>
    <div class="col-md-2">
        <input type="text"
            name="employee_id"
            id="employee_id"
            class="form-control"
            value="{{ old('employee_id', $employee->id) }}"
            disabled
        >
    </div>

    <label for="employee_name" class="col-md-3 col-form-label text-md-right">Nombre del empleado:</label>
    <div class="col-md-5">
        <input type="text"
            name="employee_name"
            id="employee_name"
            class="form-control"
            value="{{ old('employee_name', $employee->full_name) }}"
            disabled
        >
    </div>
</div>

<hr>

<div class="form-group row">
    <label for="name" class="col-md-2 col-form-label text-md-right">Nombre:*</label>
    <div class="col-md-10">
        <input type="text" name="name" id="name"
            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
            value="{{ old('name', $loadFamiliar->name) }}"
        >
        @if($errors->has('name'))
            <span class="text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="relationship" class="col-md-2 col-form-label text-md-right">Parentezco:*</label>
    <div class="col-md-4">
        <select name="relationship" id="relationship" class="custom-select">
            <option value=""></option>
            @foreach(trans('familiars.relationship') as $type => $relationship)
               <option value="{{ $type }}"
                   {{ old('relationship', $loadFamiliar->relationship) == $relationship ? ' selected' : '' }}>
                   {{ $relationship }}
               </option>
            @endforeach
       </select>

        @if($errors->has('relationship'))
            <span class="text-danger">
                <strong>{{ $errors->first('relationship') }}</strong>
            </span>
        @endif
    </div>

    <label for="document" class="col-md-2 col-form-label text-md-right">Cédula:*</label>
    <div class="col-md-4">
        <input type="text" name="document" id="document"
            class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}"
            value="{{ old('document', $loadFamiliar->document) }}"
        >
        @if($errors->has('document'))
            <span class="text-danger">
                <strong>{{ $errors->first('document') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="sex" class="col-md-2 col-form-label text-md-right">Género:*</label>
    <div class="col-md-4">
        <select name="sex" id="sex" class="custom-select">
            <option value=""></option>
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
        </select>
        @if($errors->has('sex'))
            <span class="text-danger">
                <strong>{{ $errors->first('sex') }}</strong>
            </span>
        @endif
    </div>

    <label for="sex" class="col-md-2 col-form-label text-md-right">Nació el:*</label>
    <div class="col-md-4">
        <input type="date"
            name="born_at"
            id="born_at"
            class="form-control{{ $errors->has('born_at') ? ' is-invalid' : '' }}"
            value="{{ old('born_at', $loadFamiliar->born_at) }}"
        >
        @if($errors->has('sex'))
            <span class="text-danger">
                <strong>{{ $errors->first('sex') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="instruction" class="col-md-2 col-form-label text-md-right">Instrucción:*</label>
    <div class="col-md-10">
        <select name="instruction" id="instruction" class="custom-select">
            <option value=""></option>
            @foreach(trans('familiars.instruction') as $type => $instruction)
               <option value="{{ $type }}"
                   {{ old('instruction', $loadFamiliar->instruction) == $instruction ? ' selected' : '' }}>
                   {{ $instruction }}
               </option>
            @endforeach
       </select>

        @if($errors->has('instruction'))
            <span class="text-danger">
                <strong>{{ $errors->first('instruction') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="reference" class="col-md-2 col-form-label text-md-right">Referencia:</label>
    <div class="col-md-10">
        <textarea name="reference"
            id="reference"
            cols="30"
            class="form-control"
        >{{ old('reference', $loadFamiliar->reference) }}</textarea>

        @if($errors->has('reference'))
            <span class="text-danger">
                <strong>{{ $errors->first('reference') }}</strong>
            </span>
        @endif
    </div>
</div>

<hr>

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-2">
        <button class="btn btn-primary">Guardar</button>
    </div>
</div>