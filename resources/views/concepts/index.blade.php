@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Conceptos</h1>
@can('concepts.create')
<p>
    <a href="{{ route('concepts.create') }}" class="btn btn-outline-primary">Crear concepto</a>
</p>
@endcan
@endsection

@section('content')
    @if (! $concepts->isEmpty())
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Salario del cálculo</th>
                <th scope="col">Modificado</th>
                <th scope="col">Por</th>
                <th colspan="2">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($concepts as $concept)
            <tr>
                <th scope="row">{{ $concept->id }}</th>
                <td>{{ $concept->name }}</td>
                <td>{{ $concept->type }}</td>
                <td>{{ $concept->calculation_salary }}</td>
                <td>{{ $concept->updated_at->diffForHumans() }} </td>
                <td>{{ $concept->user->name }}</td>
                <td width="10px">
                    @can('concepts.show')
                        <a href="#" class="btn btn-sm btn-outline-info">Detalle</a>
                    @endcan
                </td>
                <td width="10px">
                    @can('concepts.edit')
                        <a href="#" class="btn btn-sm btn-outline-warning">Editar</a>
                    @endcan
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="lead">No hay conceptos registrados.</p>
    @endif
@endsection