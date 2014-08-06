@extends('layouts.scaffold')

@section('main')

<h1>All NivelSocioEconomicos</h1>

<p>{{ link_to_route('NivelSocioEconomicos.create', 'Add new NivelSocioEconomico') }}</p>

@if ($NivelSocioEconomicos->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Activo</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($NivelSocioEconomicos as $NivelSocioEconomico)
				<tr>
					<td>{{{ $NivelSocioEconomico->id }}}</td>
					<td>{{{ $NivelSocioEconomico->codigo }}}</td>
					<td>{{{ $NivelSocioEconomico->nombre }}}</td>
					<td>{{{ $NivelSocioEconomico->descripcion }}}</td>
					<td>{{{ $NivelSocioEconomico->activo }}}</td>
                    <td>{{ link_to_route('NivelSocioEconomicos.edit', 'Edit', array($NivelSocioEconomico->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('NivelSocioEconomicos.destroy', $NivelSocioEconomico->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no NivelSocioEconomicos
@endif

@stop
