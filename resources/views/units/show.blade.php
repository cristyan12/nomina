@extends('layouts.master')

@section('title', 'Detalle de la unidad')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header lead">Unidad #{{ $unit->id }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <p><b>Unidad: </b></p>
                    <p><b>Última actualización: </b></p>
                </div>
                <div class="col-md-8">
                    <p>{{ $unit->name }}</p>
                    <p>{{ $unit->updated_at->format('d-m-Y') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('units.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

                {{-- <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-outline-secondary btn-sm">Editar</a> --}}
            </div>
        </div>
    </div>
</div>
@endsection