@extends('layouts.master')

@section('title', 'Departamentos')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Departamentos</strong></div>
        <div class="card-body">
            {!! Form::model($department, ['route' => ['departments.update', $department->id], 'method' => 'PUT']) !!}

                @include('departments.partials.form')

            {!! Form::close() !!}
        </div>
        @include('departments.partials.card-footer')
    </div>
</div>
@endsection