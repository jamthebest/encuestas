@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Rango de Edades <small> &gt; Editar Rango de Edad</small></h3>
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

{{ Form::model($EdadesRango, array('method' => 'PATCH', 'route' => array('EdadesRangos.update', $EdadesRango->id), 'class' => "form-horizontal" , 'role' => 'form')) }}
    <div class="form-group">
    {{ Form::label('edad_inicio', 'Edad Inicial: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('edad_inicio', null, array('class' => 'form-control', 'id' => 'edad_inicio', 'placeholder'=>'Edad Inicial del Rango', 'autofocus')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('edad_final', 'Edad Final: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('edad_final', null, array('class' => 'form-control', 'id' => 'edad_final', 'placeholder'=>'Edad Final del Rango')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::hidden('activo', 1) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
            {{ link_to_route('EdadesRangos.index', 'Cancelar', null, array('class' => 'btn btn-danger')) }}
        </div>
    </div>
{{ Form::close() }}

@stop
