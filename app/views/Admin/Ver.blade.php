@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> {{{$Encuesta->nombre}}} </h2>

@if ($errors->any())
  <div class="alert alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    @if($errors->count() > 1)
      <h4>Oh no! Se encontraron errores!</h4>
    @else
      <h4>Oh no! Se encontró un error!</h4>
    @endif
    <ul>
      {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>  
  </div>
@else
	@if (Session::has('message'))
		<div class="alert alert-success fade in">
  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		{{ Session::get('message') }}
		</div>
	@endif
@endif

@if ($Nombres)
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Celular</th>
				<th>Tel. Casa</th>
				<th>Ciudad</th>
				<th>Correo</th>
				<th>Usuario</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($Nombres as $panel)
				<tr>
					<td>{{ $panel->nombre }}</td>
					<td>{{ $panel->apellido }}</td>
					<td>{{ $panel->celular }}</td>
					<td>{{ $panel->casa }}</td>
					<td>{{ $panel->ciudad }}</td>
					<td>{{ $panel->email }}</td>
					<td>{{ $panel->usuario }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div style="margin-left:-8%">{{$Nombres->links()}}</div>
	<div class="form-group col-md-3">
		{{ link_to_route('AsignarPanelistas', 'Asignar Panelistas', array($Encuesta->id), array('class' => 'btn btn-primary')) }}
  </div>
  <div class="form-group col-md-3 col-md-offset-1">
		{{ link_to_route('Configurar', 'Atrás', array($Encuesta->id), array('class' => 'btn btn-success')) }}
  </div>
@else
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Panelistas Disponibles
  </div>
@endif

@stop
