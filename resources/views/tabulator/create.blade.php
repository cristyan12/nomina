@extends('layouts.master')

@section('title', 'Tabulador')

@section('content')

<div class="card mb-3" style="max-width: 18rem;">
    <div class="card-header">Tabulador de cargos CCP 2017-2019</div>
    <div class="card-body">
        <a href="{{ route('tabulator.create') }}" class="card-link btn btn-dark">Crear cargo</a>
    </div>
</div>
@endsection