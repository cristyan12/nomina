@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><strong>Editar usuario #{{ $user->id }}</strong></div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        @include('users.partials._form')
                    </form>
                </div>
                <div class="card-footer">
                    <div class="btn-group float-right">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection