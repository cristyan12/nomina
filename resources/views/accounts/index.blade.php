@extends('layouts.master')

@section('title')
<h1 class="pb-1 display-4">Cuentas Bancarias de la empresa</h1>
@can('accounts.create')
<p>
    <a href="{{ route('accounts.create') }}" class="btn btn-outline-primary">Nueva Cuenta</a>
</p>
@endcan
@endsection

@section('content')
    @if (! $accounts->isEmpty())
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Banco</th>
                <th scope="col">Tipo</th>
                <th scope="col"># de cuenta</th>
                <th scope="col">Modificada</th>
                <th colspan="2">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
            <tr>
                <th scope="row">{{ $account->id }}</th>
                <td>{{ $account->bank->name }}</td>
                <td>{{ $account->type }}</td>
                <td>{{ $account->number }}</td>
                <td>{{ $account->updated_at->diffForHumans() }} </td>
                <td width="10px">
                    @can('accounts.show')
                        <a href="" class="btn btn-sm btn-outline-info">Detalle</a>
                    @endcan
                </td>
                <td width="10px">
                    @can('accounts.edit')
                        <a href="" class="btn btn-sm btn-outline-warning">Editar</a>
                    @endcan
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="lead">No hay cuentas bancarias registradas aún.</p>
    @endif
@endsection