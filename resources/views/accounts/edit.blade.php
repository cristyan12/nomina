@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts._messages')
            
            <div class="card">
                <div class="card-header"><strong>Editar Cuenta de {{ $company->name }}</strong></div>
                <div class="card-body">
                    <form action="{{ route('accounts.update', $account) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('accounts.partials._form')
                    </form>
                </div>
                @can('accounts.index')
                    @component('layouts.components._card_footer')
                        {{ route('accounts.index') }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection