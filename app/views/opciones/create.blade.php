@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">{{$Encuesta->nombre}} &gt; {{$Pregunta->descripcion}} &gt; Opción <small> &gt; Nueva Opción de Pregunta</small></h3>
    <div class="pull-right">
        {{ link_to_route('Encuestas.Preguntas.Opciones.Index', 'Regresar', $Pregunta->id, array('class' => 'btn btn-sm btn-success')) }}
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

{{ Form::open(array('route' => 'Encuestas.Preguntas.Opciones.store', 'class' => "form-horizontal" , 'role' => 'form')) }}
    <div class="form-group">
    {{ Form::label('descripcion', 'Opción: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-4">
          {{ Form::textarea('descripcion', null, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder'=>'Descripción de la Opción', 'rows' => '3', 'maxlength'=>'128')) }}
      </div>
    </div>
    {{ Form::hidden('pregunta', $Pregunta->id) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
            {{ link_to_route('Encuestas.Preguntas.Opciones.Index', 'Cancelar', $Pregunta->id, array('class' => 'btn btn-danger')) }}
        </div>
    </div>
{{ Form::close() }}

@stop


