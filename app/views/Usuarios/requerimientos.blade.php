@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> Requerimientos > <small>{{{$Encuesta->nombre}}}</small> </h2>

<div class="btn-agregar col-md-5 col-md-offset-1">
	<a type="button" href="{{ URL::route('RequerimientoCiudad.nuevo', $Encuesta->id) }}" class="btn btn-danger">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Requerimiento Ciudad
	</a>
</div>
<div class="btn-agregar col-md-4">
	<a type="button" href="{{ URL::route('RequerimientoEdad.nuevo', $Encuesta->id) }}" class="btn btn-danger">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Requerimiento Edad
	</a>
</div>
<div class="btn-agregar col-md-5 col-md-offset-1">
	<a type="button" href="{{ URL::route('RequerimientoNse.nuevo', $Encuesta->id) }}" class="btn btn-danger">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Requerimiento Nivel Socio Económico
	</a>
</div>
<div class="btn-agregar col-md-3">
	<a type="button" href="{{ URL::route('RequerimientoSexo.nuevo', $Encuesta->id) }}" class="btn btn-danger">
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

<h4 class="sub-header col-md-12" style="margin-top:4%; margin-bottom:5%"> Esta encuesta podrá ser contestada por los panelistas que cumplan con los siguientes requerimientos: </h4>

@if ($texto)
	<div class="table-responsive col-md-12">
	<table class="table table-condensed">
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
			          <td>
			          	@if($text[2] == 'Ciudad')
			              {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoCiudad.destroy', $text[0]))) }}
			                  {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
			              {{ Form::close() }}
			            @elseif($text[2] == 'Edad')
			              {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoEdad.destroy', $text[0]))) }}
			                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
			              {{ Form::close() }}
			            @elseif($text[2] == 'NSE')
			              {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoNse.destroy', $text[0]))) }}
			                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
			              {{ Form::close() }}
			            @else
			              {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoSexo.destroy', $text[0]))) }}
			                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
			              {{ Form::close() }}
			            @endif
			          </td>
				</tr>
				{{ Form::hidden($Cont += 1) }}
			@endforeach
		</tbody>
	</table>
	</div>
@else
	<div class="table-responsive col-md-12">
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

<div class="text-center col-md-12" style="margin-top:5%;margin-bottom:5%">
	<h3></h3>
	<div class="col-md-4">
		<table class="table table-condensed" align="center">
			<thead>
				<tr align="center" bgcolor="#ed1c24" style="color: #ffffff; font-family: vinegar">
					<th >Edades</td>
					<th >Porcentaje</th>
				</tr>
			</thead>
				@foreach ($PromEdad as $edad)
					<tr bgcolor="#bfbfbf" style="font-family: vinegar">
						<td > {{{ $edad->edad_inicio }}} - {{{ $edad->edad_final }}} </td>
						<td > {{{ round(($edad->porcentaje / $contEdad) * 10000) / 100 }}} % </td>
					</tr>
				@endforeach
			<tbody>
				
			</tbody>
		</table>
	</div>

	
	<div class="col-md-4">
		<table class="table table-condensed" align="center">
			<thead>
				<tr align="center" bgcolor="#ed1c24" style="color: #ffffff; font-family: vinegar">
					<th>NSE</th>
					<th>Nombre</th>
					<th>Porcentaje</th>
				</tr>
			</thead>
				@foreach ($PromNSE as $nse)
					<tr style="font-family: vinegar" bgcolor="#bfbfbf" align="center" >
						<td > {{{ $nse->codigo }}} </td>
						<td > {{{ $nse->nombre }}} </td>
						<td > {{{ round(($nse->porcentaje / $contNSE) * 10000) / 100 }}} % </td>
					</tr>
				@endforeach
			<tbody>
				
			</tbody>
		</table>
	</div>

	<div class="col-md-4">
		<table class="table table-condensed" align="center">
			<thead>
				<tr align="center" bgcolor="#ed1c24" style="color: #ffffff; font-family: vinegar">
					<th>Sexo</th>
					<th>Porcentaje</th>
				</tr>
			</thead>
				@foreach ($PromSexo as $sexo)
					<tr bgcolor="#bfbfbf" style="font-family: vinegar">
						<td> {{{ $sexo->nombre }}} </td>
						<td> {{{ round(($sexo->porcentaje / $contSexo) * 10000) / 100 }}} % </td>
					</tr>
				@endforeach
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>

<div class="form-group col-md-12 text-center">
  <div class="col-md-4 col-md-offset-4">
  	@if(Pregunta::where('encuesta', $Encuesta->id)->count())
  	  <a type="button" href="{{ URL::route('Encuestas.index') }}" class="btn btn-primary">
	    Terminar
	  </a>
  	@else
	  <a type="button" href="{{ URL::route('Encuestas.Preguntas.Agregar', $Encuesta->id) }}" class="btn btn-primary">
	    Terminar
	  </a>
	@endif
  </div>
</div>

@stop
