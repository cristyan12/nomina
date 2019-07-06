@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><strong>Editar permiso #{{ $permission->id }}</strong></div>
                <div class="card-body">
                    {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'PUT']) !!}

                        @include('permissions.partials._form')

                    {!! Form::close() !!}
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