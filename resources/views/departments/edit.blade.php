@extends('layouts.master')

@section('title', 'Departamentos')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Departamentos</strong></div>
		        <div class="card-body">
		            {!! Form::model($department, ['route' => ['departments.update', $department->id], 'method' => 'PUT']) !!}

		                @include('departments.partials.form')

		            {!! Form::close() !!}
		        </div>
		        @include('departments.partials.card-footer')
		    </div>
		</div>
    </div>
</div>
@endsection