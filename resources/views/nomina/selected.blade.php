@extends('layouts.master')

@section('title')
    <h1 class="pb-1 display-4">{{ $nomina->name }}</h1>
@endsection

@section('content')
    @if (! $employees->isEmpty())
    <table class="table table-hover table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="row">Cédula</th>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Cargo</th>
            <th>Salario base</th>
            <th scope="row">HExtras</th>
            <th>Jornada</th>
            <th>TViaje</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td width="10px">{{ $employee->document }}</td>
                    <td>{{ str_limit($employee->full_name, 23) }}</td>
                    <td>{{ str_limit($employee->profile->department->name, 20) }}</td>
                    <td>{{ strtoupper($employee->profile->position->name) }}</td>
                    <td>{{ $employee->profile->position->format_salary }}</td>
                    <form action="">
                        <div class="form-group col-md-2">
                            <td width="10px">
                                <input class="form-control form-control-sm" type="text" name="hours">
                            </td>
                        </div>

                        <div class="form-group col-md-2">
                            <td width="10px">
                                <select class="custom-select custom-select-sm" name="journal">
                                    <option value="">...</option>
                                    <option value="d">D - Diurna</option>
                                    <option value="m">M - Mixta</option>
                                    <option value="n">N - Nocturna</option>
                                </select>
                            </td>
                        </div>

                        <div class="form-group col-md-2">
                            <td width="20px">
                                <input class="form-control form-control-sm" type="text" name="travel">
                            </td>
                        </div>

                        <td width="10px">
                            <button type="submit" class="btn btn-outline-warning btn-sm">Editar</button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $employees->render() }}
    @else
        <p class="lead">No hay trabajadores registrados en esta nómina.</p>
    @endif
@endsection