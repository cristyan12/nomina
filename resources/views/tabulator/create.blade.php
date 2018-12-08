@extends('layouts.master')

@section('content')

<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
    <div class="card-header">Tabulador</div>
    <div class="card-body">
        <div class="card-title">Tabulador de cargos CCP 2017-2019</div>
        <a href="{{ route('tabulator.create') }}" class="card-link btn btn-dark">Crear cargo</a>
    </div>
</div>
@endsection