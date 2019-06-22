@extends('layouts.master')

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
		        <div class="card-footer">
					<div class="btn-group float-right">
				        <a href="{{ route('positions.index') }}" class="btn btn-outline-secondary btn-sm">
				        	Ir al listado
				        </a>
				    </div>
				</div>
    		</div>
		</div>
	</div>
</div>
@endsection