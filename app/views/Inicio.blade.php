@extends('layouts.scaffold')

@section('main')

@if(Session::has('message'))
	<div class="alert alert-success fade in">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    {{ Session::get('message') }}
	</div>
@endif

<div class="row" style="margin-top:15%;">
	<div class="col-md-12 text-center"><img src="images/imagen.png" width="400"></div>
	<div class="col-md-12 text-left" style="margin-top:2%;">
		<!--<img src="images/slogan.gif">-->
		<!--<h2 class="text-center" style="color:blue;">The power of instant consumer knowledge</h2>-->
	</div>
</div>

@stop