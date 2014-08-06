@extends('layouts.scaffold')

@section('main')

<h1>Show RequerimientoNse</h1>

<p>{{ link_to_route('RequerimientoNses.index', 'Return to all RequerimientoNses') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Encuesta</th>
				<th>Nse</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $RequerimientoNse->id }}}</td>
					<td>{{{ $RequerimientoNse->encuesta }}}</td>
					<td>{{{ $RequerimientoNse->nse }}}</td>
                    <td>{{ link_to_route('RequerimientoNses.edit', 'Edit', array($RequerimientoNse->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoNses.destroy', $RequerimientoNse->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
