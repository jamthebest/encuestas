@extends('layouts.scaffold')

@section('main')

<h1>All EdadesRangos</h1>

<p>{{ link_to_route('EdadesRangos.create', 'Add new EdadesRango') }}</p>

@if ($EdadesRangos->count())
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
			@foreach ($EdadesRangos as $EdadesRango)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no EdadesRangos
@endif

@stop
