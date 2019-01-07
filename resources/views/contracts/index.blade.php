@extends('layouts.master')

@section('title')
<div class="display-4">Contratos</div>

<a href="{{ route('contracts.create') }}" class="btn btn-outline-primary">Nuevo Contrato</a>
@endsection

@section('content')

@if(! $contracts->count() == 0)
<table class="table table-borderless table-striped table-hover">
    <tr>
        <thead class="bg-dark text-white">
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Tipo</div></th>
            <th><div class="lead">Duración</div></th>
            <th colspan="2">
                &nbsp;
            </th>
        </thead>
    </tr>
    <tbody>
    @foreach($contracts as $contract)
        <tr>
            <td>{{ $contract->id }}</td>
            <td>{{ $contract->type }}</td>
            <td>{{ $contract->duration }}</td>
            <td>
                <a class="btn btn-outline-info btn-sm" href="{{ route('contracts.show', $contract) }}">
                    Ver detalle
                </a>
            </td>
            <td>
                <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-outline-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $contracts->render() }}
@else
    <p class="lead">No hay contratos registrados aún.</p>
@endif
@endsection