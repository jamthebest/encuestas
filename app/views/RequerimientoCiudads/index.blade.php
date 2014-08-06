@extends('layouts.scaffold')

@section('main')

<h1>All RequerimientoCiudads</h1>

<p>{{ link_to_route('RequerimientoCiudads.create', 'Add new RequerimientoCiudad') }}</p>

@if ($RequerimientoCiudads->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Encuesta</th>
				<th>Ciudad</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($RequerimientoCiudads as $RequerimientoCiudad)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no RequerimientoCiudads
@endif

@stop
