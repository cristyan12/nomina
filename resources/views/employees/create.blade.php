@extends('layouts.master')

@section('title', 'Crear Empleado')

@section('content')

<div class="col-md-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Empleados</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'employees.store']) }}

                @include('employees.partials.form')

            {{ Form::close() }}
        </div>
        <div class="card-footer">
            <div class="btn-group float-right">
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm">
                    Ir al listado
                </a>
            </div>
        </div>
    </div>
</div>
@endsection