@extends('layouts.master')

@section('title', 'Crear Sucursal')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Sucursales</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'branches.store']) }}

                @include('branches.partials.form')

            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection