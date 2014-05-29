@extends('layouts.scaffold')

@section('main')

<h1>Show Respuesta</h1>

<p>{{ link_to_route('Encuestas.Respuestas.index', 'Return to all respuestas') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Descripcion</th>
				<th>Opcion</th>
		</tr>
	</thead>

	<tbody>
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
	</tbody>
</table>

@stop
