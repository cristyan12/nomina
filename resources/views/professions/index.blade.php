@extends('layouts.master')

@section('title')
<div class="display-4">Profesiones</div>

@can('professions.create')
    <a href="{{ route('professions.create') }}" class="btn btn-outline-primary">Nueva Profesión</a>
@endcan
@endsection

@section('content')

@if(! $professions->count() == 0)
<div class="table-responsive">
    <table class="table table-borderless table-striped table-hover">
        <tr>
            <thead class="bg-dark text-white">
                <th scope="col"><div class="lead">#</div></th>
                <th><div class="lead">Profesión</div></th>
                <th><div class="lead">Actualización</div></th>
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
                <td>{{ $profession->updated_at->diffForHumans() }}</td>
                @can('professions.show')
                <td width="10px">
                    <a class="btn btn-outline-info btn-sm" href="{{ route('professions.show', $profession) }}">
                        Detalle
                    </a>
                </td>
                @endcan
                @can('professions.edit')
                <td width="10px">
                    <a href="{{ route('professions.edit', $profession) }}" class="btn btn-outline-warning btn-sm">
                        Editar
                    </a>
                </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $professions->render() }}
@else
    <p class="lead">No hay profesiones registradas aún.</p>
@endif
@endsection