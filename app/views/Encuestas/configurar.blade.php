@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h2 class="pull-left"><span class="glyphicon glyphicon-cog"></span>Configuración <small>{{{$encuesta->nombre}}}</small></h2>
    <div class="pull-right">
        <a href="{{{ URL::previous() }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>
</div>

@if (Session::has('message'))
    <div class="alert alert-info fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('message') }}
    </div>
@endif

<div class="btn-agregar text-center" style="margin-top:3%">
	{{ link_to_route('Encuestas.edit', 'Editar Encuesta', array($encuesta->id), array('class' => 'btn btn-primary', 'style' => 'width:200px; height:200px; padding-top: 10%')) }}
	{{ link_to_route('Encuestas.copiar', 'Duplicar Encuesta', array($encuesta->id), array('class' => 'btn btn-success', 'style' => 'width:200px; height:200px; padding-top: 10%; margin-left:3%')) }}
	{{ Form::open(array('method' => 'DELETE', 'route' => array('Encuestas.destroy', $encuesta->id))) }}
    	{{ Form::submit('Eliminar', array('class' => 'btn btn-danger', 'style' => 'width:200px; height:200px; margin-top:3%; padding-top: 2%')) }}
  	{{ Form::close() }}
</div>
@stop
