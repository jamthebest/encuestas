@extends('layouts.scaffold')

@section('main')

<h1>Show Pago</h1>

<p>{{ link_to_route('Encuestas.Pagos.index', 'Return to all pagos') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
				<th>Monto</th>
				<th>Fecha</th>
				<th>Encuesta</th>
				<th>Descripcion</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $pago->id }}}</td>
					<td>{{{ $pago->monto }}}</td>
					<td>{{{ $pago->fecha }}}</td>
					<td>{{{ $pago->encuesta }}}</td>
					<td>{{{ $pago->descripcion }}}</td>
                    <td>{{ link_to_route('Encuestas.Pagos.edit', 'Edit', array($pago->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.Pagos.destroy', $pago->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
