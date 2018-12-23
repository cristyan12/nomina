@extends('layouts.master')

@section('title', 'Tabulador')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Tabulador de cargos CCP 2017-2019</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'positions.store']) }}

                @include('positions.partials.form')

            {{ Form::close() }}
        </div>
        @include('positions.partials.card-footer')
    </div>
</div>
@endsection