@extends('layouts.scaffold')

@section('main')

<h1>All Ciudades</h1>

<p>{{ link_to_route('Ciudades.create', 'Add new Ciudad') }}</p>

@if ($Ciudades->count())
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
			@foreach ($Ciudades as $Ciudad)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no Ciudades
@endif

@stop
