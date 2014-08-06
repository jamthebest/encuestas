@extends('layouts.scaffold')

@section('main')

<h1>Create Ciudad</h1>

{{ Form::open(array('route' => 'Ciudades.store')) }}
	<ul>
        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::text('id') }}
        </li>

        <li>
            {{ Form::label('nombre', 'Nombre:') }}
            {{ Form::text('nombre') }}
        </li>

        <li>
            {{ Form::label('descripcion', 'Descripcion:') }}
            {{ Form::text('descripcion') }}
        </li>

        <li>
            {{ Form::label('activo', 'Activo:') }}
            {{ Form::text('activo') }}
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


