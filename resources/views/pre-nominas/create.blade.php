@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts._messages')

            <div class="card">
                <div class="card-header">
                    <strong>
                        Carga de datos | {{ $nomina->name }} | {{ $employee->full_name }}
                    </strong>
                </div>
                <div class="card-body">
                    <span class="lead">Periodos: {{ $nomina->periods ?: '0'}}</span>
                    <br><br>
                    <p>Primer periodo: {{ $nomina->first_date_period }}</p>
                    <p>Primer periodo: {{ $nomina->last_date_period }}</p>
                </div>
                @can('nomina.index')
                    @component('layouts.components._card_footer')
                        {{ route('pre-nominas.index') }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection