@extends('layouts.scaffold')

@section('main')

<div class="row">
	<div class="col-md-3"><h2>Inicio > <small></small></h2></div>
</div>

@if(Session::has('message'))
	<div class="alert alert-success fade in">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    {{ Session::get('message') }}
	</div>
@endif

<div class="row">
	<div class="col-md-6"><img src="images/icon.png" height="400"></div>
	<div class="col-md-6" style="margin-top:2%;">
		
		<h2>Para mejorar el ambiente laboral del país, Unitec ha creado "XXXXX", un sevicio de asesoría para las empresas del sector público y privado</h2>
		<h2>Este sevicio brinda soluciones para todas aquellas instituciones que no cuentan con un personal capacitado en determinada área o disciplina.</h2>
	</div>
</div>

@stop