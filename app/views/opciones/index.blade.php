@extends('layouts.scaffold')

@section('main')

<h1>All Opciones</h1>

<p>{{ link_to_route('Encuestas.Preguntas.Opciones.create', 'Add new opcione') }}</p>

@if ($opciones->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Descripcion</th>
				<th>Pregunta</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($opciones as $opcione)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no opciones
@endif

@stop
