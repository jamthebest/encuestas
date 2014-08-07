@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h2 class="pull-left sub-header"><span class="glyphicon glyphicon-cog"></span> {{{$Encuesta->nombre}}} </h2>
    <div class="pull-right">
    	{{ link_to_route('Configurar', ' Regresar', array($Encuesta->id), array('class' => 'btn btn-success glyphicon glyphicon-arrow-left')) }}
    </div>
</div>

<!--<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
-->
	<h4 class="sub-header col-md-4"><span class=""></span><strong>Cantidad de Panelistas:</strong> <h3 style="margin-top:3%"> {{{$Encuesta->panelistas}}} </h3> </h4>
	<h4 class="sub-header col-md-12"><span class=""></span><strong>Requerimientos de Panelistas:</strong> </h4>
	@if ($texto)
		<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<thead>
				<tr>
					<th>N°</th>
					<th>Requerimiento</th>
				</tr>
			</thead>

			<tbody>
			{{ Form::hidden($Cont = 1) }}
				@foreach ($texto as $text)
					<tr>
						<td>{{{ $Cont }}}</td>
						<td>{{{ $text[1] }}}</td>
					</tr>
					{{ Form::hidden($Cont += 1) }}
				@endforeach
			</tbody>
		</table>
		</div>
	@else
		<div class="table-responsive">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>N°</th>
					<th>Requerimiento</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>{{{ 1 }}}</td>
					<td>{{{ 'Esta Encuesta no tiene requerimientos por lo tanto cualquier persona asignada la puede responder' }}}</td>
				</tr>
			</tbody>
		</table>
		</div>
	@endif
<!--</div>-->

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

{{ Form::open(array('route' => array('Asignar.Search', $Encuesta->id))) }}
	<div class="form-group">
    {{ Form::label('SearchLabel', 'Busqueda: ', array('class' => 'col-md-1 control-label', 'style'=>'margin-top:2%;margin-bottom:2%;')) }}
    <div class="col-md-3" style="margin-top:2%;margin-bottom:2%;">
      {{ Form::select('ciudad', $Ciudades, $Seleccionados[0], array('class' => 'col-md-1 form-control', 'id' => 'ciudad')) }}
    </div>
    <div class="col-md-3" style="margin-top:2%;margin-bottom:2%;">
      {{ Form::select('nse', $NSE, $Seleccionados[1], array('class' => 'col-md-1 form-control', 'id' => 'nse')) }}
    </div>
    <div class="col-md-2" style="margin-top:2%;margin-bottom:2%;">
      {{ Form::select('edad', $Edades, $Seleccionados[2], array('class' => 'col-md-1 form-control', 'id' => 'edad')) }}
    </div>
    <h4  class="col-md-1" style="margin-top:2%;margin-bottom:2%;">Hasta</h4>
    <div class="col-md-2" style="margin-top:2%;margin-bottom:2%;">
      {{ Form::select('hasta', $Edades, $Seleccionados[3], array('class' => 'col-md-1 form-control', 'id' => 'hasta')) }}
    </div>
    <div class="col-md-3 col-md-offset-4" style="margin-top:2%;margin-bottom:2%;">
      {{ Form::select('sexo', array('Busque por Sexo','M', 'F'), $Seleccionados[4], array('class' => 'col-md-1 form-control', 'id' => 'sexo')) }}
    </div>
    <div class="col-md-12 text-center" style="margin-top:1%;margin-bottom:2%;">
      {{ Form::submit('Buscar', array('class' => 'btn btn-success btn-sm' )) }}
    </div>
	</div>
{{ Form::close() }}

@if ($Panelistas)
{{ Form::open(array('route' => 'AgregarPanelistas.store', 'class' => "form-horizontal", 'role' => 'form')) }}
	{{ Form::hidden('Encuesta', $Encuesta->id) }}
	<table class="table table-striped table-bordered" style="margin-left:-10%;">
		<thead>
			<tr>
				<th>Agregar</th>
				<th>Usuario</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Edad</th>
				<th>Celular</th>
				<th>Tel. Casa</th>
				<th>Correo</th>
				<th>Ciudad</th>
				<th>Status</th>
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
					<td>{{ array_key_exists($Nombres[$panel->id - 3]->id_panel, $Edad) ? $Edad[$Nombres[$panel->id - 3]->id_panel] : '?' }}</td>
					<td>{{ $Nombres[$panel->id - 3]->celular }}</td>
					<td>{{ $Nombres[$panel->id - 3]->casa }}</td>
					<td>{{{ $panel->correo }}}</td>
					<td>{{{ $Nombres[$panel->id - 3]->ciudad }}}</td>
					<td>{{{ $Nombres[$panel->id - 3]->status }}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="form-group col-md-2 col-md-push-5">
    {{ Form::submit('Terminar', array('class' => 'btn btn-primary')) }}
  </div>
  <div class="form-group col-md-2 col-md-push-5">
    {{ link_to_route('Configurar', 'Cancelar', array($Encuesta->id), array('class' => 'btn btn-danger')) }}
  </div>
{{ Form::close() }}
@else
	<div class="alert alert-danger" style="margin-top:25%;">
    <strong>Oh no!</strong> No hay Panelistas Disponibles
  </div>
@endif

@stop
