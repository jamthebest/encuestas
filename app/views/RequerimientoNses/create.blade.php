@extends('layouts.scaffold')

@section('main')

<h1>Create RequerimientoNse</h1>

{{ Form::open(array('route' => 'RequerimientoNse.store')) }}
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


