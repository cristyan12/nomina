@extends('layouts.master')

@section('title')
<div class="display-4">Profesiones</div>

<a href="{{ route('professions.create') }}" class="btn btn-outline-primary">Nueva Profesión</a>
@endsection

@section('content')

@if(! $professions->count() == 0)
<table class="table table-borderless table-striped table-hover">
    <tr>
        <thead class="bg-dark text-white">
            <th><div class="lead">ID</div></th>
            <th><div class="lead">Profesión</div></th>
            <th colspan="2">
                &nbsp;
            </th>
        </thead>
    </tr>
    <tbody>
    @foreach($professions as $profession)
        <tr>
            <td>{{ $profession->id }}</td>
            <td>{{ $profession->title }}</td>
            <td width="10px">
                <a class="btn btn-outline-info btn-sm" href="{{ route('professions.show', $profession) }}">
                    Ver detalle
                </a>
            </td>
            <td width="10px">
                <a href="{{ route('professions.edit', $profession) }}" class="btn btn-outline-warning btn-sm">
                    Editar
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $professions->render() }}
@else
    <p class="lead">No hay profesiones registradas aún.</p>
@endif
@endsection