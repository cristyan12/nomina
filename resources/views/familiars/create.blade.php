@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts._messages')
            
            <div class="card">
                <div class="card-header"><strong>Registro de cargas familiares del trabajador {{ $employee->full_name }}</strong></div>
                <div class="card-body">
                    <form action="{{ route('familiars.store') }}" method="POST">
                        @csrf
                        @include('familiars.partials._form')
                    </form>
                </div>
                @can('familiars.index')
                    @component('layouts.components._card_footer')
                        {{ route('familiars.index', $employee) }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection