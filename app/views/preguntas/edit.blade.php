@extends('layouts.scaffold')

@section('main')

<h1>Edit Pregunta</h1>
{{ Form::model($pregunta, array('method' => 'PATCH', 'route' => array('Encuestas.Preguntas.update', $pregunta->id))) }}
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
            {{ Form::label('tipo', 'Tipo:') }}
            {{ Form::input('number', 'tipo') }}
        </li>

        <li>
            {{ Form::label('encuesta', 'Encuesta:') }}
            {{ Form::input('number', 'encuesta') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('Encuestas.Preguntas.show', 'Cancel', $pregunta->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
