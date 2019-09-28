@if($loadFamiliar->exists)
    <form action="{{ route('familiars.store') }}" method="POST">
        @method('PUT')
@else
    <form action="{{ route('familiars.store') }}" method="POST">
@endif
    @csrf
        <input type="hidden" name="employee_id" value="{{ $employee->id }}">

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
                <select name="relationship" id="relationship" class="custom-select{{ $errors->has('relationship') ? ' is-invalid' : ''  }}">
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
                <select name="sex" id="sex" class="custom-select{{ $errors->has('sex') ? ' is-invalid' : '' }}">
                    <option value=""></option>
                    @foreach(trans('familiars.genre') as $genre => $sex)
                        <option value="{{ $genre }}"{{ old('sex', $loadFamiliar->sex) == $sex ? ' selected' : '' }}>{{ $sex }}</option>
                    @endforeach
                </select>

                @if($errors->has('sex'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('sex') }}</strong>
                    </span>
                @endif
            </div>

            <label for="born_at" class="col-md-2 col-form-label text-md-right">Nació el:*</label>
            <div class="col-md-4">
                <input type="date"
                    name="born_at"
                    id="born_at"
                    class="form-control{{ $errors->has('born_at') ? ' is-invalid' : '' }}"
                    value="{{ old('born_at', $loadFamiliar->born_at) }}"
                >
                @if($errors->has('born_at'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('born_at') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="instruction" class="col-md-2 col-form-label text-md-right">Instrucción:*</label>
            <div class="col-md-10">
                <select name="instruction" class="custom-select{{ $errors->has('instruction') ? ' is-invalid' : ''  }}">
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
                <textarea name="reference" class="form-control">{{ old('reference', $loadFamiliar->reference) }}</textarea>
            </div>
        </div>

        <hr>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-2">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>