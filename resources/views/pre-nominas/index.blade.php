@extends('layouts.master')

@section('title')
    <h1 class="pb-1 display-4">Nóminas</h1>
@endsection

@section('content')
    @if (! empty($nominas))
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Modificada</th>
                <th colspan="1">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($nominas as $nomina)
            <tr>
                <th scope="row">{{ $nomina->id }}</th>
                <td>{{ $nomina->name }}</td>
                <td>{{ $nomina->type }}</td>
                <td>{{ $nomina->updated_at->diffForHumans() }} </td>
                <td width="10px">
                    <a href="{{ route('pre-nominas.show', $nomina) }}"
                        class="btn btn-sm btn-outline-info"
                    >
                        Seleccionar
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No hay nóminas registradas.</p>
    @endif
@endsection