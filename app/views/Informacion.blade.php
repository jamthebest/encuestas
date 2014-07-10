@extends('layouts.scaffold')

@section('main')

@if(Session::has('message'))
	<div class="alert alert-success fade in">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    {{ Session::get('message') }}
	</div>
@endif

<div class="row" style="margin-top:5%;">
	<div class="col-md-6"><img src="images/resultados.png" height="400"></div>
	<div class="col-md-6" style="margin-top:2%;">
		
		<h2 style="font-family: 'palatino linotype', palatino, serif;font-size: 30px;text-align: justify;color:#0B614B">
		Esta es una página con la cual puede realizar encuastas a un público específico y obtener
		estadísticas para su negocio<br><br>
		Info Factory le brinda la oportunidad de poder efectuar sus investigaciones de mercado a través
		de una red de panelisatas que contestarán sus preguntas.</h2>
	</div>
</div>

@stop