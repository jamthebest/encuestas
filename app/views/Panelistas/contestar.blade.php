@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
  <h2 class="pull-left sub-header" style="margin-bottom:5%"><span class="glyphicon glyphicon-cog"></span> {{$Encuesta->nombre}} </h2>
  <div class="pull-right">
    <a href="{{{ URL::to('MisEncuestas') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
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

@if ($Encuesta)
{{ Form::open(array('route' => array('Respuestas.store', $Encuesta->id), 'class' => "form-horizontal" , 'role' => 'form')) }}
  @foreach ($Preguntas as $pregunta)
    <div class="form-group">
    <h2>{{ Form::label('opcion', '¿' . $pregunta->descripcion . '?' , array('class' => 'col-md-12 text-center', 'style' => 'margin-bottom:3%;font-family: georgia, serif;font-size: 25px;font-weight: bold;font-style: italic;text-transform: uppercase;word-spacing: 2pt;color:#3104B4')) }}</h2>
      <div class="col-md-3"></div>
      <div class="col-md-6 text-center" style="margin-bottom:1%">
        @if ($pregunta->tipo == 1)
          {{ Form::text('opcion' . $pregunta->id, null, array('class' => 'form-control', 'id' => 'nombre', 'placeholder'=>'Respuesta', 'maxlength'=>'128', 'style' => 'font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold;color:#088A08')) }}
        @else 
          @if($pregunta->tipo == 2)
            @foreach ($Opciones as $opcion)
              @if ($opcion->pregunta == $pregunta->id)
                <div style="font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold;color:#088A08">
                {{ $opcion->descripcion }} {{ Form::radio('opcion' . $pregunta->id, $opcion->id) }}<br>
                </div>
              @endif
            @endforeach
          @else 
            @if($pregunta->tipo == 3)
              @foreach ($Opciones as $opcion)
                @if ($opcion->pregunta == $pregunta->id)
                  <div style="display:none;">{{ $opc[$cont] = $opcion->descripcion }}</div>
                  <div style="display:none;">{{ $cont++ }}</div>
                @endif
              @endforeach
              {{ Form::select('opcion' . $pregunta->id, $opc, '0', array('class' => 'form-control', 'id' => 'opcion', 'style' => 'font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold;color:#088A08')) }}
            @else
              @if($pregunta->tipo == 4)
                @foreach ($Opciones as $opcion)
                  @if ($opcion->pregunta == $pregunta->id)
                    <div style="font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold;color:#088A08">
                    {{ $opcion->descripcion }} {{ Form::radio('opcion' . $pregunta->id, $opcion->id) }} <br>
                    </div>
                  @endif
                @endforeach
              @else
                @foreach ($Opciones as $opcion)
                  @if ($opcion->pregunta == $pregunta->id)
                    <div style="font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold;color:#088A08">
                    {{ $opcion->descripcion }} {{ Form::checkbox('opcion' . $pregunta->id . '.' . $opcion->id, $opcion->id) }} <br>
                    </div>
                  @endif
                @endforeach
              @endif
            @endif
          @endif
        @endif
        <div style="display:none;">{{ $cont = 0 }}</div>
      </div>
      <div class="page-header clearfix">
      </div>
    </div>
  @endforeach
  <div class="text-center">
    {{ Form::submit('Enviar Respuestas', array('class' => 'btn btn-primary', 'style' => 'margin-top:3%; margin-bottom: 5%')) }}
  </div>
{{ Form::close() }}
@else
  <div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Encuestas Disponibles
  </div>
@endif

@stop
