@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header" style="margin-bottom:5%"><span class="glyphicon glyphicon-cog"></span> {{$Encuesta->nombre}} </h2>

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

@if ($Encuesta)
{{ Form::open(array('route' => array('Panelistas.store', $Encuesta->id), 'class' => "form-horizontal" , 'role' => 'form')) }}
  @foreach ($Preguntas as $pregunta)
    <div class="form-group">
    {{ Form::label('opcion', '¿' . $pregunta->descripcion . '?' , array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-4">
        @if ($pregunta->tipo == 1)
          {{ Form::text('opcion' . $pregunta->id, null, array('class' => 'form-control', 'id' => 'nombre', 'placeholder'=>'Respuesta', 'maxlength'=>'128')) }}
        @else 
          @if($pregunta->tipo == 2)
            @foreach ($Opciones as $opcion)
              @if ($opcion->pregunta == $pregunta->id)
                {{ $opcion->descripcion }} {{ Form::radio('opcion' . $pregunta->id, $opcion->id) }}<br>
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
              {{ Form::select('opcion' . $pregunta->id, $opc, '0', array('class' => 'form-control', 'id' => 'opcion')) }}
            @else
              @if($pregunta->tipo == 4)
                @foreach ($Opciones as $opcion)
                  @if ($opcion->pregunta == $pregunta->id)
                    {{ $opcion->descripcion }} {{ Form::radio('opcion' . $pregunta->id, $opcion->id) }} <br>
                  @endif
                @endforeach
              @else
                @foreach ($Opciones as $opcion)
                  @if ($opcion->pregunta == $pregunta->id)
                    {{ $opcion->descripcion }} {{ Form::checkbox('opcion' . $pregunta->id . '.' . $opcion->id, $opcion->id) }} <br>
                  @endif
                @endforeach
              @endif
            @endif
          @endif
        @endif
        <div style="display:none;">{{ $cont = 0 }}</div>
      </div>
    </div>
  @endforeach
  {{ Form::submit('Enviar Respuestas', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@else
  <div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Encuestas Disponibles
  </div>
@endif

@stop
