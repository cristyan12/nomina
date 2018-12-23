@extends('layouts.master')

@section('title', 'Tabulador')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Editar Cargo #{{ $position->id }}: {{ $position->name }}</strong></div>
        <div class="card-body">
            {!! Form::model($position, ['route' => ['positions.update', $position->id], 'method' => 'PUT']) !!}

                @include('positions.partials.form')

            {!! Form::close() !!}
        </div>
        @include('positions.partials.card-footer')
    </div>
</div>
@endsection