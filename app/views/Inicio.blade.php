@extends('layouts.scaffold')

@section('main')

@if(Session::has('message'))
	<div class="alert alert-success fade in">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    {{ Session::get('message') }}
	</div>
@endif

<div class="row" style="margin-top:15%;">
	<div class="col-md-12 text-center"><img src="images/image.png" width="400"></div>
	<div class="col-md-12 text-center" style="margin-top:2%;">
		<div class="col-md-12 text-center"><img src="images/slogan.gif"></div>
		<!--<h2>El poder instantaneo del conocimiento del consumidor</h2>-->
	</div>
</div>

@stop