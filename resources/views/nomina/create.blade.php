@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts._messages')
            
            <div class="card">
                <div class="card-header"><strong>Crear nómina</strong></div>
                <div class="card-body">
                    <form action="{{ route('nomina.store') }}" method="POST">
                        @csrf
                        @include('nomina.partials._form')
                    </form>
                </div>
                @can('nomina.index')
                    @component('layouts.components._card_footer')
                        {{ route('nomina.index') }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection