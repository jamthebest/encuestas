@extends('layouts.scaffold')

@section('main')

<h1>All Precios</h1>

<p>{{ link_to_route('Precios.create', 'Add new Precio') }}</p>

@if ($Precios->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Preguntas</th>
				<th>Panelistas</th>
				<th>Precio</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($Precios as $Precio)
				<tr>
					<td>{{{ $Precio->id }}}</td>
					<td>{{{ $Precio->preguntas }}}</td>
					<td>{{{ $Precio->panelistas }}}</td>
					<td>{{{ $Precio->precio }}}</td>
                    <td>{{ link_to_route('Precios.edit', 'Edit', array($Precio->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Precios.destroy', $Precio->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no Precios
@endif

@stop
