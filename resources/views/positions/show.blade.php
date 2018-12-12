@extends('layouts.master')

@section('title', 'Detalle del cargo')

@section('content')

<div class="card mb-3">
    <div class="card-header">Cargo #{{ $position->id }}</div>
    <div class="card-body">
        <p><b>Código SISDEM: </b>{{ $position->code }}</p>
        <p><b>Nombre del Cargo: </b>{{ $position->name }}</p>
        <p><b>Salario Básico: </b>{{ $position->basic_salary }}</p>
        <p><b>Fecha de última actualización: </b>{{ $position->updated_at }}</p>
    </div>
</div>
@endsection