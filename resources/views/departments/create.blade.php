@extends('layouts.master')

@section('title', 'Crear Departamento')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Departamentos</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'departments.store']) }}

                @include('departments.partials.form')

            {{ Form::close() }}
        </div>
        @include('departments.partials.card-footer')
    </div>
</div>
@endsection