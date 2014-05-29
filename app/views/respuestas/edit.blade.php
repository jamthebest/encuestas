@extends('layouts.scaffold')

@section('main')

<h1>Edit Respuesta</h1>
{{ Form::model($respuesta, array('method' => 'PATCH', 'route' => array('Encuestas.Respuestas.update', $respuesta->id))) }}
	<ul>
        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::input('number', 'id') }}
        </li>

        <li>
            {{ Form::label('descripcion', 'Descripcion:') }}
            {{ Form::textarea('descripcion') }}
        </li>

        <li>
            {{ Form::label('opcion', 'Opcion:') }}
            {{ Form::input('number', 'opcion') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('Encuestas.Respuestas.show', 'Cancel', $respuesta->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
