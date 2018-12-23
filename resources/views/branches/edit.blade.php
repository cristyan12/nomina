@extends('layouts.master')

@section('title', 'Sucursales')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Sucursales</strong></div>
        <div class="card-body">
            {!! Form::model($branch, ['route' => ['branches.update', $branch->id], 'method' => 'PUT']) !!}

                @include('branches.partials.form')

            {!! Form::close() !!}
        </div>
        @include('branches.partials.card-footer')
    </div>
</div>
@endsection