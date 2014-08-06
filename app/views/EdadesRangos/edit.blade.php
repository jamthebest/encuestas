@extends('layouts.scaffold')

@section('main')

<h1>Edit EdadesRango</h1>
{{ Form::model($EdadesRango, array('method' => 'PATCH', 'route' => array('EdadesRangos.update', $EdadesRango->id))) }}
	<ul>
        <li>
            {{ Form::label('id', 'Id:') }}
            {{ Form::text('id') }}
        </li>

        <li>
            {{ Form::label('edad_inicio', 'Edad_inicio:') }}
            {{ Form::text('edad_inicio') }}
        </li>

        <li>
            {{ Form::label('edad_final', 'Edad_final:') }}
            {{ Form::text('edad_final') }}
        </li>

        <li>
            {{ Form::label('activo', 'Activo:') }}
            {{ Form::text('activo') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('EdadesRangos.show', 'Cancel', $EdadesRango->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
