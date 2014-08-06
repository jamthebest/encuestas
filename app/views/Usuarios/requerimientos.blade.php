@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> Requerimientos </h2>

<div class="btn-agregar">
	<a type="button" href="{{ URL::route('RequerimientoCiudad.nuevo', $Encuesta->id) }}" class="btn btn-success">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Requerimiento Ciudad
	</a>
</div>
<div class="btn-agregar">
	<a type="button" href="{{ URL::route('RequerimientoEdad.create') }}" class="btn btn-success">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Requerimiento Edad
	</a>
</div>
<div class="btn-agregar">
	<a type="button" href="{{ URL::route('RequerimientoNse.create') }}" class="btn btn-success">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Requerimiento Nivel Socio Económico
	</a>
</div>
<div class="btn-agregar">
	<a type="button" href="{{ URL::route('RequerimientoSexo.create') }}" class="btn btn-success">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Requerimiento Sexo
	</a>
</div>

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

@if ($ReqCiudades->count())
	@if ($ReqEdades->count())
		<h4 class="sub-header col-md-6"> Ciudades </h4>
		<h4 class="sub-header col-md-6"> Edades </h4>
	@else
		<h4 class="sub-header col-md-6"> Ciudades </h4>
	@endif
	<div class="table-responsive col-md-6">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Descripción</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($ReqCiudades as $ciudad)
				<tr>
					<td>{{{ $Ciudades[$ciudad->ciudad - 1]->nombre }}}</td>
					<td>{{{ $Ciudades[$ciudad->ciudad - 1]->descripcion }}}</td>
			          <td>
			              {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoCiudad.destroy', $ciudad->id))) }}
			                  {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
			              {{ Form::close() }}
			          </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
@endif

@if ($ReqEdades->count())
	<div class="table-responsive col-md-6">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Rango de Edad</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($ReqEdades as $edad)
				<tr>
					<td>{{{ $Edades[$edad->rango - 1]->edad_inicio }}} - {{{ $Edades[$edad->rango]->edad_final }}}</td>
			          <td>
			              {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoEdad.destroy', $edad->id))) }}
			                  {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
			              {{ Form::close() }}
			          </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
@endif

@if ($ReqNSE->count())
	@if ($ReqEdades->count())
		<h4 class="sub-header col-md-6"> Nivel Socio Económico </h4>
		<h4 class="sub-header col-md-6"> Sexo </h4>
	@else
		<h4 class="sub-header col-md-6"> Nivel Socio Económico </h4>
	@endif
	<div class="table-responsive cold-md-6">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Código</th>
				<th>Nombre</th>
				<th>Descripción</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($ReqNSE as $nse)
				<tr>
					<td>{{{ $NSE[$nse->nse - 1]->codigo }}}</td>
					<td>{{{ $NSE[$nse->nse - 1]->nombre }}}</td>
					<td>{{{ $NSE[$nse->nse - 1]->descripcion }}}</td>
			          <td>
			              {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoNse.destroy', $nse->id))) }}
			                  {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
			              {{ Form::close() }}
			          </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
@endif

@if ($Sexo->count())
	<div class="table-responsive cold-md-6">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Sexo</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($Sexo as $sexo)
				<tr>
					<td>{{{ $sexo->sexo == 1 ? 'Hombres' : ($sexo->sexo == 0 ? 'Mujeres' : 'Ambos') }}}</td>
			          <td>
			              {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoSexo.destroy', $sexo->id))) }}
			                  {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
			              {{ Form::close() }}
			          </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
@endif

@if(!($ReqCiudades->count() || $ReqEdades->count() || $ReqNSE->count() || $Sexo->count()))
	<div class="alert alert-danger">
		<strong>Oh no!</strong> No hay Usuarios Disponibles
	</div>
@endif

<div class="form-group col-md-12 text-center">
  <div class="col-md-4 col-md-offset-4">
    <a type="button" href="{{ URL::route('Encuestas.Preguntas.Agregar', $Encuesta->id) }}" class="btn btn-primary">
      Terminar
  	</a>
  </div>
</div>

@stop
