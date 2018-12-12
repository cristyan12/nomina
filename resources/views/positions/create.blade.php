@extends('layouts.master')

@section('title', 'Tabulador')

@section('content')

<div class="col-md-6">
    <div class="card mb-3">
        <div class="card-header">Tabulador de cargos CCP 2017-2019</div>
        <div class="card-body">
            {{ Form::open(['route' => 'positions.store']) }}

                @include('positions.partials.form')

            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection