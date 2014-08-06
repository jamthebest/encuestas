@extends('layouts.scaffold')

@section('main')

<h1>Edit RequerimientoCiudad</h1>
{{ Form::model($RequerimientoCiudad, array('method' => 'PATCH', 'route' => array('RequerimientoCiudad.update', $RequerimientoCiudad->id))) }}
	<ul>
        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::text('id') }}
        </li>

        <li>
            {{ Form::label('encuesta', 'Encuesta:') }}
            {{ Form::text('encuesta') }}
        </li>

        <li>
            {{ Form::label('ciudad', 'Ciudad:') }}
            {{ Form::text('ciudad') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('RequerimientoCiudad.show', 'Cancel', $RequerimientoCiudad->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
