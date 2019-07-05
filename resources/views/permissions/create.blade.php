@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts._messages')
            
            <div class="card">
                <div class="card-header"><strong>Crear permiso</strong></div>
                <div class="card-body">
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf
                        @include('permissions.partials._form')
                    </form>
                </div>
                @can('permissions.index')
                    @component('layouts.components._card_footer')
                        {{ route('permissions.index') }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection