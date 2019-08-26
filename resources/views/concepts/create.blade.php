@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts._messages')
            
            <div class="card">
                <div class="card-header"><strong>Conceptos</strong></div>
                <div class="card-body">
                    <form action="{{ route('concepts.store') }}" method="POST">
                        @csrf
                        @include('concepts.partials._form')
                    </form>
                </div>
                @can('concepts.index')
                    @component('layouts.components._card_footer')
                        {{ route('concepts.index') }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection