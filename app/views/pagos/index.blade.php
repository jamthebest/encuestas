@extends('layouts.scaffold')

@section('main')

<h1>All Pagos</h1>

<p>{{ link_to_route('Encuestas.Pagos.create', 'Add new pago') }}</p>

@if ($pagos->count())
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
			@foreach ($pagos as $pago)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no pagos
@endif

@stop
