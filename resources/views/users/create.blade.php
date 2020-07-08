@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Nuevo usuario</strong></div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        @include('users.partials._form')
                    </form>
                </div>
                @can('users.index')
                    @component('layouts.components._card_footer')
                        {{ route('users.index') }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection