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
    {{ link_to_route('VerPanelistas', 'Ver Panelistas', array($Encuesta->id), array('class' => 'btn btn-warning', 'style'=>'width:160px; height:160px; margin-right:6%; padding-top: 8%; margin-left:-87%')) }}
    {{ link_to_route('AsignarPanelistas', 'Asignar Panelistas', array($Encuesta->id), array('class' => 'btn btn-primary', 'style'=>'width:160px; height:160px; margin-right:5%; padding-top: 8%')) }}
    {{ link_to_route('Pagos.Index', 'Pagos', array($Encuesta->id), array('class' => 'btn btn-info', 'style'=>'width:160px; height:160px; padding-top: 8%')) }}
    {{ Form::open(array('method' => 'POST', 'route' => array('Promopuntos', $Encuesta->id), 'class' => 'col-md-3 center-text', 'style'=>'padding-top: 2%; margin-top:20%;margin-left:14%')) }}
      <div class="modal fade" id="promopuntos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:13%">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title text-center" id="myModalLabel">Editar Promopuntos</h4>
            </div>
            <div class="modal-body">
              {{ Form::text('promopuntos', $Encuesta->promopuntos, array('class' => 'form-control', 'id' => 'promopuntos', 'placeholder' => 'Ingrese la cantidad de Promopuntos', 'maxlength'=>'19')) }}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
            </div>
          </div>
        </div>
      </div>
      <button type="button" class="col-md-3 center-text btn btn-default" data-toggle="modal" data-target="#promopuntos" style='width:160px; height:160px;margin-right:2%; padding-top: 8%;'>
        Editar Promopuntos
      </button>
    {{ Form::close() }}
    {{ Form::open(array('method' => 'POST', 'route' => array('Fin.Pagos', $Encuesta->id), 'class' => 'col-md-3 center-text', 'style'=>'padding-top: 2%; margin-top:20%;')) }}
      @if ($Encuesta->pagada == 1)
        {{ Form::submit('Pago Vencido', array('class' => 'btn btn-success', 'style'=>'width:160px; height:160px')) }}
      @else
        {{ Form::submit('Pago Vencido', array('class' => 'btn btn-success', 'style'=>'width:160px; height:160px', 'disabled')) }}
      @endif
    {{ Form::close() }}
    @if ($Encuesta->activa == 1)
      {{ Form::open(array('method' => 'POST', 'route' => array('Encuestas.desactivar', $Encuesta->id), 'class' => 'col-md-3 center-text', 'style'=>'; margin-top:20%; padding-top: 2%')) }}
        {{ Form::submit('Desactivar', array('class' => 'btn btn-danger', 'style'=>'width:160px; height:160px')) }}
      {{ Form::close() }}
    @else
      {{ Form::open(array('method' => 'POST', 'route' => array('Encuestas.activar', $Encuesta->id), 'class' => 'col-md-3 center-text', 'style'=>'; margin-top:20%; padding-top: 2%')) }}
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
