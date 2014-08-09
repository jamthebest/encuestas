@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Ciudades <small> &gt; Editar Ciudad</small></h3>
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

{{ Form::model($Ciudad, array('method' => 'PATCH', 'route' => array('Ciudades.update', $Ciudad->id), 'class' => "form-horizontal" , 'role' => 'form')) }}
	<div class="form-group">
    {{ Form::label('nombre', 'Ciudad: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-4">
          {{ Form::text('nombre', null, array('class' => 'form-control', 'id' => 'nombre', 'placeholder'=>'Nombre de la Ciudad', 'autofocus')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('descripcion', 'Descripción:', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-4">
          {{ Form::textarea('descripcion', null, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder'=>'Descripción de la Ciudad', 'rows' => '3', 'maxlength'=>'128')) }}
      </div>
    </div>
    {{ Form::hidden('activo', 1) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
            {{ link_to_route('Ciudades.index', 'Cancelar', null, array('class' => 'btn btn-danger')) }}
        </div>
    </div>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
