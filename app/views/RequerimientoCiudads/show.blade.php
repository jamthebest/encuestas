@extends('layouts.scaffold')

@section('main')

<h1>Show RequerimientoCiudad</h1>

<p>{{ link_to_route('RequerimientoCiudads.index', 'Return to all RequerimientoCiudads') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Encuesta</th>
				<th>Ciudad</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $RequerimientoCiudad->id }}}</td>
					<td>{{{ $RequerimientoCiudad->encuesta }}}</td>
					<td>{{{ $RequerimientoCiudad->ciudad }}}</td>
                    <td>{{ link_to_route('RequerimientoCiudads.edit', 'Edit', array($RequerimientoCiudad->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoCiudads.destroy', $RequerimientoCiudad->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
