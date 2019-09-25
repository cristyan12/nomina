@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Departamentos</strong></div>
		        <div class="card-body">
		            {{ Form::open(['route' => 'departments.store']) }}

		                @include('departments.partials.form')

		            {{ Form::close() }}
		        </div>
                @can('departments.index')
                    @component('layouts.components._card_footer')
                        {{ route('departments.index') }}
                    @endcomponent
                @endcan
    		</div>
		</div>
	</div>
</div>
@endsection