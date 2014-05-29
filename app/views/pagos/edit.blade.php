@extends('layouts.scaffold')

@section('main')

<h1>Edit Pago</h1>
{{ Form::model($pago, array('method' => 'PATCH', 'route' => array('Encuestas.Pagos.update', $pago->id))) }}
	<ul>
        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::input('number', 'id') }}
        </li>

        <li>
            {{ Form::label('monto', 'Monto:') }}
            {{ Form::input('number', 'monto') }}
        </li>

        <li>
            {{ Form::label('fecha', 'Fecha:') }}
            {{ Form::text('fecha') }}
        </li>

        <li>
            {{ Form::label('encuesta', 'Encuesta:') }}
            {{ Form::input('number', 'encuesta') }}
        </li>

        <li>
            {{ Form::label('descripcion', 'Descripcion:') }}
            {{ Form::textarea('descripcion') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('Encuestas.Pagos.show', 'Cancel', $pago->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
