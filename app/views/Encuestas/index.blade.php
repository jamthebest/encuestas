@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> Mis Encuestas </h2>

<div class="btn-agregar">
	<a type="button" href="{{ URL::route('Encuestas.create') }}" class="btn btn-primary">
	  <span class="glyphicon glyphicon-file"></span> Nueva Encuesta
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
@endif

@if ($encuestas->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Despedida</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($encuestas as $encuesta)
				<tr>
					<td>{{{ $encuesta->nombre }}}</td>
					<td>{{{ $encuesta->descripcion }}}</td>
					<td>{{{ $encuesta->despedida }}}</td>
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
	<div style="margin-left:-8%">{{$encuestas->links()}}</div>
@else
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Encuestas Disponibles
  </div>
@endif

@stop
