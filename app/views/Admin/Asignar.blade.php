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
@endif

@if ($Panelistas->count())
{{ Form::open(array('route' => 'AgregarPanelistas.store', 'class' => "form-horizontal", 'role' => 'form')) }}
	{{ Form::hidden('Encuesta', $Encuesta->id) }}
	<table class="table table-striped table-bordered" style="margin-left:-10%;">
		<thead>
			<tr>
				<th>Agregar</th>
				<th>Usuario</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Celular</th>
				<th>Tel. Casa</th>
				<th>Correo</th>
				<th>Estado</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($Panelistas as $panel)
				<tr>
					@if ($panel->check == 1)
						<td>{{ Form::checkbox('A' . $panel->id, 1, array('checked'=>'checked')) }}</td>
					@else
						<td>{{ Form::checkbox('A' . $panel->id, 1) }}</td>
					@endif
					<td>{{{ $panel->username }}}</td>
					<td>{{ $Nombres[$panel->id - 3]->nombre }}</td>
					<td>{{ $Nombres[$panel->id - 3]->apellido }}</td>
					<td>{{ $Nombres[$panel->id - 3]->celular }}</td>
					<td>{{ $Nombres[$panel->id - 3]->casa }}</td>
					<td>{{{ $panel->correo }}}</td>
					<td>{{{ $panel->activo == 1 ? 'Activo' : 'Inactivo' }}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="form-group col-md-2 col-md-push-5">
    {{ Form::submit('Terminar', array('class' => 'btn btn-primary')) }}
  </div>
  <div class="form-group col-md-2 col-md-push-5">
    {{ link_to_route('Encuestas.todas', 'Cancelar', null, array('class' => 'btn btn-danger')) }}
  </div>
{{ Form::close() }}
@else
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Panelistas Disponibles
  </div>
@endif

@stop
