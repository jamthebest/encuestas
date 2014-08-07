@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Encuesta <small> &gt; Nuevo Requerimiento de Edad</small></h3>
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

{{ Form::open(array('route' => 'RequerimientoEdad.store', 'class' => "form-horizontal" , 'role' => 'form')) }}
	<div class="form-group">
        {{ Form::label('rango', 'Edades: *', array('class' => 'col-md-2 control-label')) }}
        <div class="col-md-5">
            {{ Form::select('rango', $Rango, null, array('class' => 'form-control', 'id' => 'rango')) }}
        </div>
    </div>
    {{ Form::hidden('encuesta', $id) }}
    <div class="form-group" style="margin-top:5%;">
      <div class="col-md-2 col-md-offset-2">
          {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
      </div>
      <div class="col-md-2">
          <a type="button" href="{{ URL::route('Requerimientos', $id) }}" class="btn btn-danger">
              Cancelar
          </a>
      </div>
    </div>
{{ Form::close() }}

@stop
