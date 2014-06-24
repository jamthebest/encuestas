@extends('layouts.scaffold')
  
@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Encuesta <small> &gt; Nueva Encuesta</small></h3>
    <div class="pull-right">
        <a href="{{{ URL::route('Encuestas.index') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
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

{{ Form::open(array('route' => 'Encuestas.store', 'class' => "form-horizontal" , 'role' => 'form')) }}
    <div class="form-group">
    {{ Form::label('nombre', 'Nombre: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-4">
          {{ Form::text('nombre', null, array('class' => 'form-control', 'id' => 'nombre', 'placeholder'=>'Nombre de la Encuesta', 'maxlength'=>'128')) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('descripcion', 'Descripción:', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
        {{ Form::textarea('descripcion',null, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder' => 'Descripción que se mostrará al inicio de la Encuesta', 'rows' => '3', 'maxlength'=>'256')) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('despedida', 'Despedida:', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-5">
        {{ Form::textarea('despedida',null, array('class' => 'form-control', 'id' => 'despedida', 'placeholder' => 'Despedida que se mostrará al finalizar de la Encuesta', 'rows' => '3', 'maxlength'=>'256')) }}
      </div>
    </div>
    {{ Form::hidden('usuario', Auth::user()->id) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-3 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
            <a type="button" href="{{ URL::route('Encuestas.index') }}" class="btn btn-danger">
                Cancelar
            </a>
        </div>
    </div>
{{ Form::close() }}

@stop


