@extends('layouts.master')

@section('title', 'Profesiones')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Editar profesión #{{ $profession->id }}</strong></div>
        <div class="card-body">
            {!! Form::model($profession, ['route' => ['professions.update', $profession], 'method' => 'PUT']) !!}

                @include('professions.partials.form')

            {!! Form::close() !!}
        </div>
        @include('professions.partials.card-footer')
    </div>
</div>
@endsection