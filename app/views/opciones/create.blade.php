@extends('layouts.scaffold')

@section('main')

<h1>Create Opcione</h1>

{{ Form::open(array('route' => 'Encuestas.Preguntas.Opciones.store')) }}
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


