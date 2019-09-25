@extends('layouts.master')

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
                @can('branches.index')
                    @component('layouts.components._card_footer')
                        {{ route('branches.index') }}
                    @endcomponent
                @endcan
    		</div>
		</div>
	</div>
</div>
@endsection