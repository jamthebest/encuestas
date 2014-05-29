@extends('layouts.scaffold')

@section('main')

<h1>Edit Opcione</h1>
{{ Form::model($opcione, array('method' => 'PATCH', 'route' => array('Encuestas.Preguntas.Opciones.update', $opcione->id))) }}
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
            {{ Form::label('pregunta', 'Pregunta:') }}
            {{ Form::input('number', 'pregunta') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('Encuestas.Preguntas.Opciones.show', 'Cancel', $opcione->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
