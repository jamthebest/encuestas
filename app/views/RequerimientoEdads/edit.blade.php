@extends('layouts.scaffold')

@section('main')

<h1>Edit RequerimientoEdad</h1>
{{ Form::model($RequerimientoEdad, array('method' => 'PATCH', 'route' => array('RequerimientoEdads.update', $RequerimientoEdad->id))) }}
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
            {{ Form::label('rango', 'Rango:') }}
            {{ Form::text('rango') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('RequerimientoEdads.show', 'Cancel', $RequerimientoEdad->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
