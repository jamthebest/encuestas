@extends('layouts.scaffold')

@section('main')

<h1>All Respuestas</h1>

<p>{{ link_to_route('Encuestas.Respuestas.create', 'Add new respuesta') }}</p>

@if ($respuestas->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Descripcion</th>
				<th>Opcion</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($respuestas as $respuesta)
				<tr>
					<td>{{{ $respuesta->id }}}</td>
					<td>{{{ $respuesta->descripcion }}}</td>
					<td>{{{ $respuesta->opcion }}}</td>
                    <td>{{ link_to_route('Encuestas.Respuestas.edit', 'Edit', array($respuesta->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.Respuestas.destroy', $respuesta->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no respuestas
@endif

@stop
