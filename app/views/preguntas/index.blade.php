@extends('layouts.scaffold')

@section('main')

@if ($preguntas)
	<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> {{$encuesta->nombre}} </h2>
	<div class="btn-agregar pull-left">
		{{ link_to_route('Encuestas.Preguntas.Agregar', 'Agregar Pregunta', array($id), array('class' => 'btn btn-primary')) }}
	</div>
	<div class="pull-right">
    <a href="{{{ URL::to('Encuestas') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Terminar</a>
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

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>N°</th>
				<th>Pregunta</th>
				<th>Tipo</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($preguntas as $pregunta)
				<tr>
					<td>{{{ $cont }}}</td>
					<td>{{{ $pregunta->descripcion }}}</td>
					<td>{{{ $tipos[$pregunta->tipo - 1]->nombre }}}</td>
					@if ($pregunta->tipo != 1)
					<td>{{ link_to_route('Encuestas.Preguntas.Opciones.Index', 'Ver Opciones', array($pregunta->id), array('class' => 'btn btn-success')) }}</td>
          @else
          <td>
          	<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="right" title="No Puede Agregar Opciones a este Tipo">Ver Opciones</button>
          </td>
          @endif
          <td>{{ link_to_route('Encuestas.Preguntas.edit', 'Editar', array($pregunta->id), array('class' => 'btn btn-info')) }}</td>
          <td>
              {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.Preguntas.destroy', $pregunta->id))) }}
                  {{ Form::submit('Borrar', array('class' => 'btn btn-danger')) }}
              {{ Form::close() }}
          </td>
				</tr>
				<div style="display:none;">{{$cont++}}</div>
			@endforeach
		</tbody>
	</table>
	<div style="margin-left:-8%">{{$preguntas->links()}}</div>
@else
	<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> {{$encuesta->nombre}} </h2>
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Preguntas En Esta Encuesta
  </div>
  
	<div class="btn-agregar pull-left">
		{{ link_to_route('Encuestas.Preguntas.Agregar', 'Agregar Pregunta', array($id), array('class' => 'btn btn-primary')) }}
	</div>
	<div class="pull-right">
    <a href="{{{ URL::to('Encuestas') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Terminar</a>
  </div>
@endif

@stop
