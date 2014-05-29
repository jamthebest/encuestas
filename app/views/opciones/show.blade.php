@extends('layouts.scaffold')

@section('main')

<h1>Show Opcione</h1>

<p>{{ link_to_route('Encuestas.Preguntas.Opciones.index', 'Return to all opciones') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Descripcion</th>
				<th>Pregunta</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $opcione->id }}}</td>
					<td>{{{ $opcione->descripcion }}}</td>
					<td>{{{ $opcione->pregunta }}}</td>
                    <td>{{ link_to_route('Encuestas.Preguntas.Opciones.edit', 'Edit', array($opcione->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.Preguntas.Opciones.destroy', $opcione->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
