@extends('layouts.scaffold')

@section('main')

<h1>Show Tipo</h1>

<p>{{ link_to_route('Encuestas.Preguntas.Tipos.index', 'Return to all tipos') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Nombre</th>
				<th>Descripcion</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $tipo->id }}}</td>
					<td>{{{ $tipo->nombre }}}</td>
					<td>{{{ $tipo->descripcion }}}</td>
                    <td>{{ link_to_route('Encuestas.Preguntas.Tipos.edit', 'Edit', array($tipo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.Preguntas.Tipos.destroy', $tipo->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
