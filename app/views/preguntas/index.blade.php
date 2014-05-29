@extends('layouts.scaffold')

@section('main')

<h1>All Preguntas</h1>

<p>{{ link_to_route('Encuestas.Preguntas.create', 'Add new pregunta') }}</p>

@if ($preguntas->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Descripcion</th>
				<th>Tipo</th>
				<th>Encuesta</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($preguntas as $pregunta)
				<tr>
					<td>{{{ $pregunta->id }}}</td>
					<td>{{{ $pregunta->descripcion }}}</td>
					<td>{{{ $pregunta->tipo }}}</td>
					<td>{{{ $pregunta->encuesta }}}</td>
                    <td>{{ link_to_route('Encuestas.Preguntas.edit', 'Edit', array($pregunta->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.Preguntas.destroy', $pregunta->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no preguntas
@endif

@stop
