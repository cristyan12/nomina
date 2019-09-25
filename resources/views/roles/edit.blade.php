@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Editar role #{{ $role->id }}</strong></div>
                <div class="card-body">
                    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}

                        @include('roles.partials._form')

                    {!! Form::close() !!}
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