@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Editar role #{{ $role->id }}</strong></div>
                <div class="card-body">
                    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}

                        @include('roles.partials._form')

                    {!! Form::close() !!}
                </div>
                <div class="card-footer">
                    <div class="btn-group float-right">
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection