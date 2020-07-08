@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
		        <div class="card-header"><strong>Unidades</strong></div>
		        <div class="card-body">
		            <form action="{{ route('units.update', $unit->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('units.partials.form')
                    </form>
		        </div>
                @can('units.index')
                    @component('layouts.components._card_footer')
                        {{ route('units.index') }}
                    @endcomponent
                @endcan
		    </div>
		</div>
    </div>
</div>
@endsection