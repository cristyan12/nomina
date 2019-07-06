@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <strong>Registro</strong>
                </div>
                <div class="card-body">
                    <p class="card-text lead">
                        Acceso a los módulos de registro.
                    </p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('records') }}" class="btn btn-outline-dark stretched-link">
                        Ir
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @can('nomina.index')
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">
                        <strong>Tipos de Nóminas</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Tipos de Nóminas
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('nomina.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </div>

    <hr>
    
    <div class="row mt-4">
        <div class="col-md-4">
            @can('roles.index')
                <div class="card bg-warning mb-3">
                    <div class="card-header">
                        <strong>Roles</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Roles
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-dark stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="col-md-4">
            @can('permissions.index')
                <div class="card bg-secondary text-white mb-3">
                    <div class="card-header">
                        <strong>Permisos</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Permisos
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('permissions.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="col-md-4">
            @can('users.index')
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">
                        <strong>Usuarios</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Usuarios
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>
@endsection