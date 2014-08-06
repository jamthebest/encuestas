@extends('layouts.scaffold')

@section('main')

<h1>All RequerimientoCiudad</h1>

<p>{{ link_to_route('RequerimientoCiudad.create', 'Add new RequerimientoCiudad') }}</p>

@if ($RequerimientoCiudad->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Encuesta</th>
				<th>Ciudad</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($RequerimientoCiudad as $RequerimientoCiudad)
				<tr>
					<td>{{{ $RequerimientoCiudad->id }}}</td>
					<td>{{{ $RequerimientoCiudad->encuesta }}}</td>
					<td>{{{ $RequerimientoCiudad->ciudad }}}</td>
                    <td>{{ link_to_route('RequerimientoCiudad.edit', 'Edit', array($RequerimientoCiudad->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoCiudad.destroy', $RequerimientoCiudad->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no RequerimientoCiudad
@endif

@stop
