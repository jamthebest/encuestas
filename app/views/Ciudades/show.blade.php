@extends('layouts.scaffold')

@section('main')

<h1>Show Ciudad</h1>

<p>{{ link_to_route('Ciudades.index', 'Return to all Ciudades') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Activo</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $Ciudad->id }}}</td>
					<td>{{{ $Ciudad->nombre }}}</td>
					<td>{{{ $Ciudad->descripcion }}}</td>
					<td>{{{ $Ciudad->activo }}}</td>
                    <td>{{ link_to_route('Ciudades.edit', 'Edit', array($Ciudad->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Ciudades.destroy', $Ciudad->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
