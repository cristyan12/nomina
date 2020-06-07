@extends('layouts.master')

@section('title')
    <h1 class="pb-1 display-4">Trabajadores de la {{ $nomina->name }}</h1>
@endsection

@section('content')
    @if (! empty($nomina->employees))
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Código</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th>Salario Base</th>
                <th colspan="1">Horas</th>
                <th colspan="1">Jornada</th>
                <th colspan="1">TViaje</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($nomina->employees as $employee)
            <tr>
                <th width="10px">{{ $employee->document }}</th>
                <td width="10px">{{ $employee->code }}</td>
                <td>{{ str_limit($employee->full_name, 20) }}</td>
                <td>{{ str_limit($employee->profile->department->name, 20) }}</td>
                <td>{{ str_limit($employee->profile->position->name, 10) }}</td>
                <td>{{ $employee->profile->position->format_salary }}</td>
                <form action="">
                    <div class="form-group col-md-2">
                        <td width="20px">
                            <input class="form-control form-control-sm" type="text" name="hours">
                        </td>
                    </div>

                    <div class="form-group col-md-2">
                        <td width="20px">
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
                </form>

                <td>
                    <button type="submit" class="btn btn-primary btn-sm">Grabar</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No hay nóminas registradas.</p>
    @endif
@endsection