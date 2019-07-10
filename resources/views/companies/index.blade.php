@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Empresas</h1>
{{-- @can('companies.create') --}}
<p>
    <a href="{{ route('companies.create') }}" class="btn btn-outline-primary">Nueva Empresa</a>
</p>
{{-- @endcan --}}
@endsection

@section('content')
    @if (! empty($companies))
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">RIF</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Modificado</th>
                <th colspan="3">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
            <tr>
                <th scope="row">{{ $company->id }}</th>
                <td>{{ $company->name }}</td>
                <td>{{ $company->rif }}</td>
                <td>{{ $company->city }}</td>
                <td>{{ $company->updated_at->diffForHumans() }}</td>
                {{-- @can('companies.show') --}}
                <td width="10px">
                    <a href="{{ route('companies.show', $company) }}" class="btn btn-sm btn-outline-primary">Detalle</a>
                </td>
                {{-- @endcan --}}
                {{-- @can('companies.edit') --}}
                <td width="10px">
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                </td>
                {{-- @endcan --}}
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="lead">No hay registros aún.</p>
    @endif
@endsection