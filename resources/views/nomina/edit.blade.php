@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><strong>Editar nómina #{{ $nomina->id }}</strong></div>
                <div class="card-body">
                    <form action="{{ route('nomina.update', $nomina->id) }}" method="POST">
                        @csrf
                        @method('PUT')

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