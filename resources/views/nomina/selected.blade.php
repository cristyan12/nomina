@extends('layouts.master')

@section('title')
    <h1 class="pb-1 display-5">#{{ $nomina->id }} {{ $nomina->name }}</h1>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            Lista de trabajadores de {{ $nomina->employees->unit()->name }}
        </div>
    </div>
</div>
@endsection