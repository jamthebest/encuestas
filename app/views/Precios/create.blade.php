@extends('layouts.scaffold')

@section('main')

<h1>Create Precio</h1>

{{ Form::open(array('route' => 'Precios.store')) }}
	<ul>
        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::input('number', 'id') }}
        </li>

        <li>
            {{ Form::label('preguntas', 'Preguntas:') }}
            {{ Form::input('number', 'preguntas') }}
        </li>

        <li>
            {{ Form::label('panelistas', 'Panelistas:') }}
            {{ Form::input('number', 'panelistas') }}
        </li>

        <li>
            {{ Form::label('precio', 'Precio:') }}
            {{ Form::input('number', 'precio') }}
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


