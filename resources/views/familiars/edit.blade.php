@extends('layouts.master')

@section('content')
<div class="container pt-0">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <span class="lead"><strong>
                        Editar a {{ $familiar->name}}, familiar del trabajador {{ $familiar->employee->full_name }}
                    </strong></span>
                </div>
                <div class="card-body">
                    <form action="{{ route('familiars.update', $familiar) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('familiars.partials._form')
                    </form>
                </div>
                @can('familiars.index')
                    @component('layouts.components._card_footer')
                        {{ route('familiars.index', $familiar->employee_id) }}
                    @endcomponent
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection