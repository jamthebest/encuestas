@extends('layouts.scaffold')

@section('main')

<h1>Show Encuesta</h1>

<p>{{ link_to_route('Encuestas.index', 'Return to all encuestas') }}</p>

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
	</tbody>
</table>

@stop
