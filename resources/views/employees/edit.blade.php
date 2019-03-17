@extends('layouts.master')

@section('title', 'Empleados')

@section('content')

<div class="col-xs-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Editar Empleado #{{ $employee->id }}: {{ $employee->full_name }}</strong></div>
        <div class="card-body">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')
            </form>
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