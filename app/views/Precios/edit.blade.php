@extends('layouts.scaffold')

@section('main')

<h1>Edit Precio</h1>
{{ Form::model($Precio, array('method' => 'PATCH', 'route' => array('Precios.update', $Precio->id))) }}
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
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('Precios.show', 'Cancel', $Precio->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
