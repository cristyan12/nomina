@extends('layouts.master')

@section('title', 'Detalle de la profesión')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header lead">#{{ $profession->id }} {{ $profession->title }}</div>
                <div class="card-body">
                    <fieldset disabled>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                <strong>Profesión:</strong>
                            </label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $profession->title }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">
                                <strong>Última actualización:</strong>
                            </label>
                            <div class="col-md-6">
                                <p class="form-control-plaintext">{{ $profession->updated_at->format('d-m-Y') }}</p>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="card-footer">
                    <div class="btn-group float-right">
                        <a href="{{ route('professions.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                        <a href="{{ route('professions.edit', $profession) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection