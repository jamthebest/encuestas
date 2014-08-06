@extends('layouts.scaffold')

@section('main')

<h1>Show RequerimientoEdad</h1>

<p>{{ link_to_route('RequerimientoEdads.index', 'Return to all RequerimientoEdads') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Encuesta</th>
				<th>Rango</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $RequerimientoEdad->id }}}</td>
					<td>{{{ $RequerimientoEdad->encuesta }}}</td>
					<td>{{{ $RequerimientoEdad->rango }}}</td>
                    <td>{{ link_to_route('RequerimientoEdads.edit', 'Edit', array($RequerimientoEdad->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoEdads.destroy', $RequerimientoEdad->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
