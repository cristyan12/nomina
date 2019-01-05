@extends('layouts.master')

@section('title', 'Detalle de la profesión')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header lead">Profesión #{{ $profession->id }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><b>Profesión: </b></p>
                    <p><b>Última actualización: </b></p>
                </div>
                <div class="col-md-8">
                    <p>{{ $profession->title }}</p>
                    <p>{{ $profession->updated_at->format('d-m-Y') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('professions.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                <a href="{{ route('professions.edit', $profession) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection