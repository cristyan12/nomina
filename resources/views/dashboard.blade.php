@extends('layouts.master')

@section('content')
	<div class="card-deck">
		@can('positions.index')
			<div class="card text-white bg-secondary mb-3" >
				<div class="card-header">
					<strong>Tabulador CCP 2017-2019</strong>
				</div>
				<div class="card-body">
					<p class="card-text">
						Escala salarial de los diferentes cargos
					</p>
				</div>
				<div class="card-footer">
					<a href="{{ route('positions.index') }}" class="btn btn-outline-light">
						Ir al listado de cargos
					</a>
				</div>
			</div>
		@endcan

		@can('professions.index')
			<div class="card text-white bg-success mb-3">
				<div class="card-header">
					<strong>Profesiones</strong>
				</div>
				<div class="card-body">
					<p class="card-text">
						Las profesiones de los empleados
					</p>
				</div>
				<div class="card-footer">
					<a href="{{ route('professions.index') }}" class="btn btn-outline-light">
						Ir al listado de profesiones
					</a>
				</div>
			</div>
		@endcan
		
		@can('branches.index')
			<div class="card text-white bg-warning mb-3">
				<div class="card-header">
					<strong>Sucursales</strong>
				</div>
				<div class="card-body">
					<p class="card-text">
						Sucursales
					</p>
				</div>
				<div class="card-footer">
					<a href="{{ route('branches.index') }}" class="btn btn-outline-light">
						Ir al listado de sucursales
					</a>
				</div>
			</div>
		@endcan
	</div>

	<div class="card-deck">
		@can('departments.index')
			<div class="card text-white bg-info mb-3" >
				<div class="card-header">
					<strong>Departamentos</strong>
				</div>
				<div class="card-body">
					<p class="card-text">
						Departamentos
					</p>
				</div>
				<div class="card-footer">
					<a href="{{ route('departments.index') }}" class="btn btn-outline-light">
						Ir al listado de departamentos
					</a>
				</div>
			</div>
		@endcan

		@can('units.index')
			<div class="card text-white bg-danger mb-3">
				<div class="card-header">
					<strong>Unidades</strong>
				</div>
				<div class="card-body">
					<p class="card-text">
						Unidades
					</p>
				</div>
				<div class="card-footer">
					<a href="{{ route('units.index') }}" class="btn btn-outline-light">
						Ir al listado de unidades
					</a>
				</div>
			</div>
		@endcan
		
		@can('employees.index')
			<div class="card text-white bg-dark mb-3" >
				<div class="card-header">
					<strong>Empleados</strong>
				</div>
				<div class="card-body">
					<p class="card-text">
						Empleados
					</p>
				</div>
				<div class="card-footer">
					<a href="{{ route('employees.index') }}" class="btn btn-outline-light">
						Ir al listado de empleados
					</a>
				</div>
			</div>
		@endcan
	</div>
@endsection