@extends('layouts.master')

@section('title', 'Crear Sucursal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Sucursales</strong></div>
		        <div class="card-body">
		            {{ Form::open(['route' => 'branches.store']) }}

		                @include('branches.partials.form')

		            {{ Form::close() }}
		        </div>
        		@include('branches.partials.card-footer')
    		</div>
		</div>
	</div>
</div>
@endsection