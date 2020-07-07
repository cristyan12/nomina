@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col">
        <div class="card-deck">
            @can('companies.index')
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">
                        <strong>Compañías</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">Compañías</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('companies.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan

            @can('professions.index')
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">
                        <strong>Profesiones</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Las profesiones de los empleados
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('professions.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan

            @can('positions.index')
                <div class="card text-white bg-secondary mb-3" >
                    <div class="card-header">
                        <strong>Tabulador CCP 2017-2019</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Escala salarial de los diferentes cargos
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('positions.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-deck">
            @can('branches.index')
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <strong>Sucursales</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Sucursales
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('branches.index') }}" class="btn btn-outline-dark stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan

            @can('departments.index')
                <div class="card text-white bg-info mb-3" >
                    <div class="card-header">
                        <strong>Departamentos</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Departamentos
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('departments.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan

            @can('units.index')
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">
                        <strong>Unidades</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Unidades
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('units.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan
        </div>

        <div class="card-deck">
            @can('employees.index')
                <div class="card text-white bg-dark mb-3" >
                    <div class="card-header">
                        <strong>Empleados</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Empleados
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-light stretched-link">
                            Ver lista
                        </a>
                    </div>
                </div>
            @endcan

            @can('nomina.index')
                <div class="card text-white bg-success mb-3">
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

            <div class="card text-white bg-info mb-3" >
                <div class="card-header">
                    <strong>Cuentas Bancarias</strong>
                </div>
                <div class="card-body">
                    <p class="card-text lead">
                        Cuentas Bancarias
                    </p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('accounts.index') }}" class="btn btn-outline-light stretched-link">
                        Ver lista
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection