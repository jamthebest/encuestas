@extends('layouts.scaffold')

@section('main')

<h1>Show Sexo</h1>

<p>{{ link_to_route('Sexos.index', 'Return to all Sexos') }}</p>

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
			<td>{{{ $Sexo->id }}}</td>
					<td>{{{ $Sexo->nombre }}}</td>
					<td>{{{ $Sexo->descripcion }}}</td>
					<td>{{{ $Sexo->activo }}}</td>
                    <td>{{ link_to_route('Sexos.edit', 'Edit', array($Sexo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Sexos.destroy', $Sexo->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
