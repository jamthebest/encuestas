@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Sexos <small> &gt; Editar Sexo</small></h3>
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

{{ Form::model($Sexo, array('method' => 'PATCH', 'route' => array('Sexos.update', $Sexo->id), 'class' => "form-horizontal" , 'role' => 'form')) }}
	<div class="form-group">
    {{ Form::label('nombre', 'Panelistas: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('nombre', null, array('class' => 'form-control', 'id' => 'nombre', 'placeholder'=>'Nombre a mostrar del tipo de sexo')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('descripcion', 'Descripción:', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::textarea('descripcion', null, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder'=>'Descripción del tipo de sexo', 'rows' => '3')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('porcentaje', 'Porcentaje Poblacional: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
          {{ Form::text('porcentaje', null, array('class' => 'form-control', 'id' => 'porcentaje', 'placeholder'=>'Porcentaje de personas de este sexo que miran TV')) }}
      </div>
    </div>
    {{ Form::hidden('activo', null) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
            {{ link_to_route('Sexos.index', 'Cancelar', null, array('class' => 'btn btn-danger')) }}
        </div>
    </div>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
