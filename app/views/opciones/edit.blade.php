@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Opción <small> &gt; Editar Opción</small></h3>
    <div class="pull-right">
        {{ link_to_route('Encuestas.Preguntas.Opciones.Index', 'Regresar', $opcion->pregunta, array('class' => 'btn btn-success')) }}        
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
@endif

{{ Form::model($opcion, array('method' => 'PATCH', 'route' => array('Encuestas.Preguntas.Opciones.update', $opcion->id), 'class' => "form-horizontal" , 'role' => 'form')) }}
	<div class="form-group">
    {{ Form::label('descripcion', 'Opción: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-4">
          {{ Form::textarea('descripcion', $opcion->descripcion, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder'=>'Descripción de la Opción', 'rows' => '3', 'maxlength'=>'128')) }}
      </div>
    </div>
    {{ Form::hidden('pregunta', $opcion->pregunta) }}
    <div class="form-group" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
            {{ link_to_route('Encuestas.Preguntas.Opciones.Index', 'Cancel', $opcion->pregunta, array('class' => 'btn btn-danger')) }}
        </div>
    </div>
{{ Form::close() }}

@stop
