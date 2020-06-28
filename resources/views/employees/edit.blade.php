@extends('layouts.master')

@section('content')

<div class="col-xs-9">
    <div class="card mb-3">
        <div class="card-header"><strong>Editar Empleado con el ID #{{ $employee->id }}: {{ $employee->full_name }}</strong></div>
        <div class="card-body">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')

                @include('employees.partials.edit-form')
            </form>
        </div> {{-- .card-body --}}
        @can('employees.index')
            @component('layouts.components._card_footer')
                {{ route('employees.index') }}
            @endcomponent
        @endcan
    </div>
</div>
@endsection