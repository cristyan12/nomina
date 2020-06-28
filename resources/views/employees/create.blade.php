@extends('layouts.master')

@section('content')

<div class="col-xs-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Registrar Empleado</strong></div>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf

                @include('employees.partials.form')
            </form>
        </div>
        @can('employees.index')
            @component('layouts.components._card_footer')
                {{ route('employees.index') }}
            @endcomponent
        @endcan
    </div>
</div>
@endsection