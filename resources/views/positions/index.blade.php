@extends('layouts.master')

@section('title')
<div class="display-4">Tabulador de cargos CCP 2017-2019</div>

@can('positions.create')
    <a href="{{ route('positions.create') }}" class="btn btn-outline-primary">
        Nuevo Cargo
    </a>
@endcan
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                @if(! $positions->count() == 0)
                <table class="table table-borderless table-striped table-hover">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th><div class="lead">ID</div></th>
                            <th><div class="lead">Código SISDEM</div></th>
                            <th><div class="lead">Nombre del cargo</div></th>
                            <th><div class="lead">Salario Básico</div></th>
                            <th colspan="2">
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($positions as $position)
                    <tr>
                        <td>{{ $position->id }}</td>
                        <td>{{ $position->code }}</td>
                        <td>{{ $position->name }}</td>
                        <td>{{ $position->format_salary }}</td>
                        <td width="">
                            <a class="btn btn-outline-info btn-sm" href="{{ route('positions.show', $position) }}">
                                Ver detalle
                            </a>
                        </td>
                        <td width="">
                            <a href="{{ route('positions.edit', $position) }}" class="btn btn-outline-warning btn-sm">
                                Editar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $positions->render() }}
                
                @else
                    <p class="lead">No hay cargos registrados aún.</p>
                @endif
            </div> {{-- .card --}}
        </div> {{-- .col --}}
    </div> {{-- .row --}}
</div> {{-- .container --}}
@endsection