@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><span class="lead font-weight-bold">Detalle del usuario #{{ $user->id }}</span></div>
				
				<div class="row no-gutters">
					<div class="col-md-4">
						<img src="{{ asset('img/no-image.png') }}" class="card-img">
					</div>
				
					<div class="col-md-8">
						<div class="card-body">
							<div class="card-title">
								<span class="lead">Nombre: </span><span class="lead"><strong>{{ $user->name }}</strong></span>
							</div>
							<br>
							<ul class="list-group list-group-flush mt-3">
								<li class="list-group-item">
									<div class="d-flex justify-content-between">
										<span class="lead">Tipo:</span><span class="lead"><strong>ADMIN</strong></span>
									</div>
								</li>
								<li class="list-group-item">
									<div class="d-flex justify-content-between">
										<span class="lead">Correo:</span><span class="lead"><strong>{{ $user->email }}</strong></span>
									</div>
								</li>
								<li class="list-group-item">
									<div class="d-flex justify-content-between">
										<span class="lead">Actualización:</span><span class="lead"><strong>{{ $user->updated_at->diffForHumans() }}</strong></span>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="card-footer">
		            <div class="btn-group float-right">
		                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">Ir al listado</a>

		                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary btn-sm">Editar</a>
		            </div>
		        </div>
			</div>
		</div>
	</div>
</div>
@endsection
