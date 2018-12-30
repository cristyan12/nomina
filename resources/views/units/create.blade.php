@extends('layouts.master')

@section('title', 'Crear Unidad')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Unidades</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'units.store']) }}

                @include('units.partials.form')

            {{ Form::close() }}
        </div>
        @include('units.partials.card-footer')
    </div>
</div>
@endsection