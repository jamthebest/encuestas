@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Pregunta <small> &gt; Editar Pregunta</small></h3>
    <div class="pull-right">
        {{ link_to_route('Encuestas.Preguntas.Index', 'Regresar', $Encuesta->id, array('class' => 'btn btn-success')) }}        
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

{{ Form::model($pregunta, array('method' => 'PATCH', 'route' => array('Encuestas.Preguntas.update', $pregunta->id), 'class' => "form-horizontal" , 'role' => 'form')) }}
    <div class="form-group">
    {{ Form::label('descripcion', 'Pregunta: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-4">
          {{ Form::textarea('descripcion', $pregunta->descripcion, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder'=>'Descripción de la Pregunta', 'rows' => '3', 'maxlength'=>'128')) }}
      </div>
    </div>
    <div class="form-group">
    {{ Form::label('tipo', 'Tipo: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-4">
        {{ Form::select('tipo', $tipos, $pregunta->tipo, array('class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Descripción', 'id' => 'tipo', 'placeholder' => '#' )) }}
      </div>
    </div>
    {{ Form::hidden('encuesta', $Encuesta->id) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
          {{ link_to_route('Encuestas.Preguntas.Index', 'Cancelar', $Encuesta->id, array('class' => 'btn btn-danger')) }}
            
        </div>
    </div>
{{ Form::close() }}

@stop
