@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> Encuestas </h2>

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

@if ($Encuestas->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Usuario</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($Encuestas as $encuesta)
				<tr>
					<td>{{{ $encuesta->nombre }}}</td>
					<td>{{{ $Usuarios[$encuesta->usuario]->username }}}</td>
					<td>{{ link_to_route('VerPanelistas', 'Ver Panelistas', array($encuesta->id), array('class' => 'btn btn-warning')) }}</td>
					<td>{{ link_to_route('AsignarPanelistas', 'Asignar Panelistas', array($encuesta->id), array('class' => 'btn btn-primary')) }}</td>
					<td>{{ link_to_route('Encuestas.Preguntas.Index', 'Ver Preguntas', array($encuesta->id), array('class' => 'btn btn-success')) }}</td>
          <td>{{ link_to_route('Encuestas.edit', 'Editar', array($encuesta->id), array('class' => 'btn btn-info')) }}</td>
          <td>
              {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.destroy', $encuesta->id))) }}
                  {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
              {{ Form::close() }}
          </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Encuestas Disponibles
  </div>
@endif

@stop
