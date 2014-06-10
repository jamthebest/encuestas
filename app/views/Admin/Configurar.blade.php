@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> Configuración <small> > {{$Encuesta->nombre}} </small> </h2>
<div class="page-header clearfix">
    <div class="pull-right">
        <a href="{{{ URL::route('Encuestas.todas') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
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
  <div class="btn-agregar" style="text-align: center; margin-top:3%">
    {{ link_to_route('VerPanelistas', 'Ver Panelistas', array($Encuesta->id), array('class' => 'btn btn-warning', 'style'=>'width:160px; height:160px; margin-right:2%; padding-top: 9%')) }}
    {{ link_to_route('AsignarPanelistas', 'Asignar Panelistas', array($Encuesta->id), array('class' => 'btn btn-primary', 'style'=>'width:160px; height:160px; margin-right:2%; padding-top: 9%')) }}
    {{ link_to_route('AsignarPanelistas', 'Pagos', array($Encuesta->id), array('class' => 'btn btn-info', 'style'=>'width:160px; height:160px; padding-top: 9%')) }}
    @if ($Encuesta->activa == 1)
      {{ Form::open(array('method' => 'POST', 'route' => array('Encuestas.desactivar', $Encuesta->id), 'class' => 'center-text', 'style'=>'padding-top: 2%')) }}
        {{ Form::submit('Desactivar', array('class' => 'btn btn-danger', 'style'=>'width:160px; height:160px')) }}
      {{ Form::close() }}
    @else
      {{ Form::open(array('method' => 'POST', 'route' => array('Encuestas.activar', $Encuesta->id), 'class' => 'center-text', 'style'=>'padding-top: 2%')) }}
        {{ Form::submit('Activar', array('class' => 'btn btn-success', 'style'=>'width:160px; height:160px;')) }}
      {{ Form::close() }}
    @endif
  </div>
@else
  <div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Encuestas Disponibles
  </div>
@endif

@stop
