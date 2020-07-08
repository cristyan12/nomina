@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Editar profesión #{{ $profession->id }}</strong></div>
                <div class="card-body">
                    <form action="{{ route('professions.update', $profession->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('professions.partials.form')
                    </form>
                </div>
                <div class="card-footer">
                    <div class="btn-group float-right">
                        <a href="{{ route('professions.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection