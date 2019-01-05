@extends('layouts.master')

@section('title', 'Crear Profesión')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Profesiones</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'professions.store']) }}

                @include('professions.partials.form')

            {{ Form::close() }}
        </div>
        @include('professions.partials.card-footer')
    </div>
</div>
@endsection