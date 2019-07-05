@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><strong>Editar permiso #{{ $permission->id }}</strong></div>
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        @include('permission.partials._form')
                    </form>
                </div>
                {{-- @can('users.index') --}}
                    @component('layouts.components._card_footer')
                        {{ route('permission.index') }}
                    @endcomponent
                {{-- @endcan --}}
            </div>
        </div>
    </div>
</div>
@endsection