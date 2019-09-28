@extends('layouts.master')

@section('content')
<div class="container pt-0">
    <div class="row justify-content-center">
        <div class="col-md-10">
            {{-- @include('layouts._messages') --}}

            <div class="card">
                <div class="card-header">
                    <span class="lead"><strong>
                        Editar la carga familiar del trabajador {{ $employee->full_name }}
                    </strong></span>
                </div>
                <div class="card-body">
                    @include('familiars/partials._form', ['loadFamiliar' => $loadFamiliar])
                </div>
                @can('familiars.index')
                    @component('layouts.components._card_footer')
                        {{ route('familiars.index', $employee) }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection