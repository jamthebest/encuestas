@extends('layouts.scaffold')

@section('main')
	
	@if(Session::has('message'))
		<div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('message') }}
        </div>
	@endif

	{{ Form::open(array('url' => '/Login', 'method' => 'POST')) }}
		<div class="col-md-5 col-md-offset-3" style="margin-top:15%">
			<label for="username">Usuario:</label>
			{{ Form::text('username',null, array('style' => 'margin-bottom:5%;', 'class' => 'form-control', 'id' => 'username', 'placeholder' => 'Usuario', 'autofocus')) }}
			<label for="password">Contraseña:</label>
			{{ Form::password('password', array('style' => 'margin-bottom:10%;', 'class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña')) }}
			{{ Form::submit('Ingrersar', array('class' => 'btn btn-lg btn-primary btn-block')) }}
		    
	    </div>
	{{ Form::close() }}

@stop
