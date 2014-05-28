@extends('layouts.scaffold')

@section('main')

<h1>Edit Encuesta</h1>
{{ Form::model($encuesta, array('method' => 'PATCH', 'route' => array('Encuestas.update', $encuesta->id))) }}
	<ul>
        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::input('number', 'id') }}
        </li>

        <li>
            {{ Form::label('nombre', 'Nombre:') }}
            {{ Form::text('nombre') }}
        </li>

        <li>
            {{ Form::label('descripcion', 'Descripcion:') }}
            {{ Form::textarea('descripcion') }}
        </li>

        <li>
            {{ Form::label('despedida', 'Despedida:') }}
            {{ Form::textarea('despedida') }}
        </li>

        <li>
            {{ Form::label('promopuntos', 'Promopuntos:') }}
            {{ Form::text('promopuntos') }}
        </li>

        <li>
            {{ Form::label('usuario', 'Usuario:') }}
            {{ Form::text('usuario') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('Encuestas.show', 'Cancel', $encuesta->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
