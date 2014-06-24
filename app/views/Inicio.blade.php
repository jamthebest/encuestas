@extends('layouts.scaffold')

@section('main')

@if(Session::has('message'))
	<div class="alert alert-success fade in">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    {{ Session::get('message') }}
	</div>
@endif

<div class="row" style="margin-top:5%;">
	<div class="col-md-12 text-center"><img src="images/logo.png" width="400"></div>
	<div class="col-md-12 text-center" style="margin-top:2%;">
		
		<h2>El poder instantaneo del conocimiento del consumidor</h2>
	</div>
</div>

@stop