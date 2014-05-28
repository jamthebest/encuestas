@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> Mis Encuestas </h2>

<div class="btn-agregar">
	<a type="button" href="{{ URL::route('Encuestas.create') }}" class="btn btn-primary">
	  <span class="glyphicon glyphicon-file"></span> Nueva Encuesta
	</a>
</div>

@if ($encuestas->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Despedida</th>
				<th>Promopuntos</th>
				<th>Usuario</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($encuestas as $encuesta)
				<tr>
					<td>{{{ $encuesta->id }}}</td>
					<td>{{{ $encuesta->nombre }}}</td>
					<td>{{{ $encuesta->descripcion }}}</td>
					<td>{{{ $encuesta->despedida }}}</td>
					<td>{{{ $encuesta->promopuntos }}}</td>
					<td>{{{ $encuesta->usuario }}}</td>
                    <td>{{ link_to_route('Encuestas.edit', 'Edit', array($encuesta->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.destroy', $encuesta->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
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
