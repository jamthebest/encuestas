@extends('layouts.scaffold')

@section('main')

<h1>Create Pago</h1>

{{ Form::open(array('route' => 'Encuestas.Pagos.store')) }}
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
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


