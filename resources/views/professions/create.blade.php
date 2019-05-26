@extends('layouts.master')

@section('title', 'Crear Profesión')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Profesiones</strong></div>
		        <div class="card-body">
		            {{ Form::open(['route' => 'professions.store']) }}

		                @include('professions.partials.form')

		            {{ Form::close() }}
        		</div>
        		@include('branches.partials.card-footer')
        	</div>
    	</div>
	</div>
</div>
@endsection