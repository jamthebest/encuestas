@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Niveles Socio Económicos <small> &gt; Nuevo Nivel Socio Económico</small></h3>
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

{{ Form::open(array('route' => 'NivelSocioEconomicos.store', 'class' => "form-horizontal" , 'role' => 'form')) }}
	<div class="form-group">
    {{ Form::label('codigo', 'Código: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('codigo', null, array('class' => 'form-control', 'id' => 'codigo', 'placeholder'=>'Código del Nivel Socio Económico', 'autofocus')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('nombre', 'Nombre: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('nombre', null, array('class' => 'form-control', 'id' => 'nombre', 'placeholder'=>'Nombre a mostrar del Nivel Socio Económico')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('descripcion', 'Descripción:', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::textarea('descripcion', null, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder'=>'Descripción del Nivel Socio Económico', 'rows' => '3')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('porcentaje', 'Porcentaje Poblacional: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('porcentaje', null, array('class' => 'form-control', 'id' => 'porcentaje', 'placeholder'=>'Porcentaje de personas de este NSE que miran TV')) }}
      </div>
    </div>
    {{ Form::hidden('activo', 1) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
            {{ link_to_route('NivelSocioEconomicos.index', 'Cancelar', null, array('class' => 'btn btn-danger')) }}
        </div>
    </div>
{{ Form::close() }}

@stop