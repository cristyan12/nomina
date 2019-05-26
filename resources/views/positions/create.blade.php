@extends('layouts.master')

@section('title', 'Tabulador')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Tabulador de cargos CCP 2017-2019</strong></div>
		        <div class="card-body">
		            {{ Form::open(['route' => 'positions.store']) }}

		                @include('positions.partials.form')

		            {{ Form::close() }}
		        </div>
        		@include('positions.partials.card-footer')
    		</div>
		</div>
	</div>
</div>
@endsection