@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><strong>Editar Cargo #{{ $position->id }}: {{ $position->name }}</strong></div>
				<div class="card-body">
					<form action="{{ route('positions.update', $position->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('positions.partials.form')
                    </form>
				</div>
                @can('positions.index')
                    @component('layouts.components._card_footer')
                        {{ route('positions.index') }}
                    @endcomponent
                @endcan
			</div>
		</div>
	</div>
</div>
@endsection