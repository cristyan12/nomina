@extends('layouts.master')

@section('title', 'Crear Contrato')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Tipos de contrato</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'contracts.store']) }}

                @include('contracts.partials.form')

            {{ Form::close() }}
        </div>
        @include('contracts.partials.card-footer')
    </div>
</div>
@endsection