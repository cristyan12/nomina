@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Sucursales</strong></div>
                <div class="card-body">
                    <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('branches.partials.form')
                    </form>
                </div>
                @can('branches.index')
                    @component('layouts.components._card_footer')
                        {{ route('branches.index') }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

