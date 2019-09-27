@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Cargas familiares de: {{ $employee->full_name }}</h1>
@can('familiars.create')
<p>
    <a href="{{ route('familiars.create', $employee->id) }}" class="btn btn-outline-primary">Nueva carga familiar</a>
</p>
@endcan
@endsection

@section('content')
    @if(! $employee->familiars->isEmpty())
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Parentesco</th>
                <th scope="col">Cédula</th>
                <th scope="col">Edad</th>
                <th colspan="3">&nbsp;</th>
            </thead>
            <tbody>
                @foreach($employee->familiars as $familiar)
                <tr>
                    <td scope="row">{{ $familiar->id }}</td>
                    <td>{{ $familiar->name }}</td>
                    <td>{{ $familiar->relationship }}</td>
                    <td>{{ $familiar->document }}</td>
                    <td>{{ $familiar->born_at->age }} años</td>
                    @can('familiars.show')
                    <td width="10px">
                        <a href="{{ route('familiars.show', $familiar) }}" class="btn btn-sm btn-success">Detalle</a>
                    </td>
                    @endcan
                    <td width="10px">
                        <a href="#" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                    <td width="10px">
                        <a href="#" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="lead">No hay cargas familiares registradas aún.</p>
    @endif
@endsection