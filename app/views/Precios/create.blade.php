@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Precios <small> &gt; Nuevo Precio</small></h3>
    <div class="pull-right">
        <a href="{{{ URL::previous() }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>
</div>

@if ($errors->any())
  <div class="alert alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    @if($errors->count() > 1)
      <h4>Oh no! Se encontraron errores!</h4>
    @else
      <h4>Oh no! Se encontró un error!</h4>
    @endif
    <ul>
      {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>  
  </div>
@else
  @if (Session::has('message'))
    <div class="alert alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      {{ Session::get('message') }}
    </div>
  @endif
@endif

{{ Form::open(array('route' => 'Precios.store', 'class' => "form-horizontal" , 'role' => 'form')) }}
	<div class="form-group">
    {{ Form::label('preguntas', 'Preguntas: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('preguntas', null, array('class' => 'form-control', 'id' => 'preguntas', 'placeholder'=>'Número máximo de preguntas', 'autofocus')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('panelistas', 'Panelistas: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('panelistas', null, array('class' => 'form-control', 'id' => 'panelistas', 'placeholder'=>'Número máximo de panelistas')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('precio', 'Precio: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('precio', null, array('class' => 'form-control', 'id' => 'precio', 'placeholder'=>'Precio por encuestas con estos parámetros')) }}
      </div>
    </div>
    {{ Form::hidden('activo', 1) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
            {{ link_to_route('Precios.index', 'Cancelar', null, array('class' => 'btn btn-danger')) }}
        </div>
    </div>
{{ Form::close() }}

@stop