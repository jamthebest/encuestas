@extends('layouts.scaffold')

@section('main')

<h1>Edit RequerimientoSexo</h1>
{{ Form::model($RequerimientoSexo, array('method' => 'PATCH', 'route' => array('RequerimientoSexos.update', $RequerimientoSexo->id))) }}
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
            {{ Form::label('sexo', 'Sexo:') }}
            {{ Form::text('sexo') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('RequerimientoSexos.show', 'Cancel', $RequerimientoSexo->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
