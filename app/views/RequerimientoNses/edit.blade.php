@extends('layouts.scaffold')

@section('main')

<h1>Edit RequerimientoNse</h1>
{{ Form::model($RequerimientoNse, array('method' => 'PATCH', 'route' => array('RequerimientoNses.update', $RequerimientoNse->id))) }}
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
            {{ Form::label('nse', 'Nse:') }}
            {{ Form::text('nse') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('RequerimientoNses.show', 'Cancel', $RequerimientoNse->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
