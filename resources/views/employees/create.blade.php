@extends('layouts.master')

@section('content')

<div class="col-xs-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Registrar Empleado</strong></div>
        <div class="card-body">
            {{ Form::open(['route' => 'employees.store']) }}

                @include('employees.partials.form')

            {{ Form::close() }}
        </div>
        @can('employees.index')
            @component('layouts.components._card_footer')
                {{ route('employees.index') }}
            @endcomponent
        @endcan
    </div>
</div>
@endsection