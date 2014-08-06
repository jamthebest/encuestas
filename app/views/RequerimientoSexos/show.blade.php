@extends('layouts.scaffold')

@section('main')

<h1>Show RequerimientoSexo</h1>

<p>{{ link_to_route('RequerimientoSexos.index', 'Return to all RequerimientoSexos') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Encuesta</th>
				<th>Sexo</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $RequerimientoSexo->id }}}</td>
					<td>{{{ $RequerimientoSexo->encuesta }}}</td>
					<td>{{{ $RequerimientoSexo->sexo }}}</td>
                    <td>{{ link_to_route('RequerimientoSexos.edit', 'Edit', array($RequerimientoSexo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('RequerimientoSexos.destroy', $RequerimientoSexo->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
