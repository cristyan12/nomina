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
            @can('security')
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">
                        <strong>Seguridad</strong>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Módulos de seguridad.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('security') }}" class="btn btn-outline-dark stretched-link">
                            Ir
                        </a>
                    </div>
                </div>
            @endcan
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
    </div> {{-- row --}}

    <hr>
</div>
@endsection