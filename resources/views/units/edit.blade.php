@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
		        <div class="card-header"><strong>Unidades</strong></div>
		        <div class="card-body">
		            {!! Form::model($unit, ['route' => ['units.update', $unit->id], 'method' => 'PUT']) !!}

		                @include('units.partials.form')

		            {!! Form::close() !!}
		        </div>
		        <div class="card-footer">
				    <div class="btn-group float-right">
				        <a href="{{ route('units.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>
				    </div>
				</div>
		    </div>
		</div>
    </div>
</div>
@endsection