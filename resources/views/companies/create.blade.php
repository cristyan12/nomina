@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Crear Empresa</strong></div>
                <div class="card-body">
                    <form action="{{ route('companies.store') }}" method="POST">
                        @csrf

                        @include('companies.partials._form')
                    </form>
                </div>
                @component('layouts.components._card_footer')
                    {{ route('companies.index') }}
                @endcomponent
            </div>
        </div>
    </div>
</div>
@endsection