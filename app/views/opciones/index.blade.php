@extends('layouts.scaffold')

@section('main')
<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> {{$encuesta->nombre}} > {{$pregunta->descripcion}} </h2>
	
@if ($opciones->count())
	<div class="btn-agregar pull-left">
		{{ link_to_route('Encuestas.Preguntas.Opciones.Agregar', 'Agregar Opción', array($id), array('class' => 'btn btn-primary')) }}
	</div>
	<div class="pull-right">
		{{ link_to_route('Encuestas.Preguntas.Index', 'Terminar', array($encuesta->id), array('class' => 'btn btn-success')) }}
  </div>

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>N°</th>
				<th>Descripcion</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($opciones as $opcion)
				<tr>
					<td>{{{ $cont }}}</td>
					<td>{{{ $opcion->descripcion }}}</td>
          <td>{{ link_to_route('Encuestas.Preguntas.Opciones.edit', 'Editar', array($opcion->id), array('class' => 'btn btn-info')) }}</td>
          <td>
              {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.Preguntas.Opciones.destroy', $opcion->id))) }}
                  {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
              {{ Form::close() }}
          </td>
				</tr>
				<div style="display:none;">{{$cont++}}</div>
			@endforeach
		</tbody>
	</table>
	<div style="margin-left:-8%">{{$opciones->links()}}</div>
@else
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Opciones En Esta Pregunta
  </div>
  <div class="btn-agregar pull-left">
		{{ link_to_route('Encuestas.Preguntas.Opciones.Agregar', 'Agregar Opción', array($id), array('class' => 'btn btn-primary')) }}
	</div>
	
  <div class="pull-right">
		{{ link_to_route('Encuestas.Preguntas.Index', 'Regresar', array($encuesta->id), array('class' => 'btn btn-success')) }}
  </div>
@endif
 
@stop
