@extends('layouts.master')

@section('title', 'Contratos')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Editar tipo de contrato #{{ $contract->id }}</strong></div>
        <div class="card-body">
            {!! Form::model($contract, ['route' => ['contracts.update', $contract], 'method' => 'PUT']) !!}

                @include('contracts.partials.form')

            {!! Form::close() !!}
        </div>
        @include('contracts.partials.card-footer')
    </div>
</div>
@endsection