@extends('layouts.scaffold')

@section('main')

<h1>Edit Ciudad</h1>
{{ Form::model($Ciudad, array('method' => 'PATCH', 'route' => array('Ciudades.update', $Ciudad->id))) }}
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
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('Ciudades.show', 'Cancel', $Ciudad->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
