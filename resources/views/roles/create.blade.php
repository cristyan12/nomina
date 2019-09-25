@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts._messages')
            
            <div class="card">
                <div class="card-header"><strong>Registrar Role</strong></div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        
                        @include('roles.partials._form')
                    </form>
                </div>
                @can('roles.index')
                    @component('layouts.components._card_footer')
                        {{ route('roles.index') }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection