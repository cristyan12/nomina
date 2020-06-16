@extends('layouts.master')

@section('title')
    <h1 class="">Trabajadores de la {{ $nomina->name }}</h1>
@endsection

@section('content')
    @if (! $nomina->employees->isEmpty())

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th scope="row">Cédula</th>
                <th>Nombre</th>
                {{-- <th>Departamento</th> --}}
                <th>Cargo</th>
                {{-- <th>Salario base</th> --}}
                <th scope="row">HExtras</th>
                <th>Jornada</th>
                <th>TViaje</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                @foreach($nomina->employees as $employee)
                    <tr>
                        <td width="10px">{{ $employee->document }}</td>
                        <td>
                            <b>
                            <p>{{ str_limit($employee->full_name, 23) }}</p>

                            <span>{{ $employee->profile->department->name }}</span>
                            </b>
                        </td>
                        {{-- <td>{{ str_limit($employee->profile->department->name, 20) }}</td> --}}
                        <td>
                            <b>
                            <p>{{ strtoupper($employee->profile->position->name) }}</p>

                            <span>Salario base:
                                Bs. {{ $employee->profile->position->format_salary }}
                            </span>
                            </b>
                        </td>
                        {{-- <td>{{ $employee->profile->position->format_salary }}</td> --}}
                        <form action="">
                            <fieldset>
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
                                    <button type="submit" class="btn btn-primary btn-sm">Grabar</button>
                                </td>
                            </fieldset>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="lead">No hay trabajadores registrados en esta nómina.</p>
    @endif
@endsection