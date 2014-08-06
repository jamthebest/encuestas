@extends('layouts.scaffold')

@section('main')

<h1>Show EdadesRango</h1>

<p>{{ link_to_route('EdadesRangos.index', 'Return to all EdadesRangos') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Edad_inicio</th>
				<th>Edad_final</th>
				<th>Activo</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $EdadesRango->id }}}</td>
					<td>{{{ $EdadesRango->edad_inicio }}}</td>
					<td>{{{ $EdadesRango->edad_final }}}</td>
					<td>{{{ $EdadesRango->activo }}}</td>
                    <td>{{ link_to_route('EdadesRangos.edit', 'Edit', array($EdadesRango->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('EdadesRangos.destroy', $EdadesRango->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
