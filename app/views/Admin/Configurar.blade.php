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
	<div class="btn-agregar" style="text-align: center; margin-top:10%">
		{{ link_to_route('VerPanelistas', 'Ver Panelistas', array($Encuesta->id), array('class' => 'btn btn-warning', 'style'=>'width:180px; height:180px; padding-top: 10%')) }}
		{{ link_to_route('AsignarPanelistas', 'Asignar Panelistas', array($Encuesta->id), array('class' => 'btn btn-primary', 'style'=>'width:180px; height:180px; padding-top: 10%')) }}
		@if ($Encuesta->activa == 1)
			{{ link_to_route('AsignarPanelistas', 'Desactivar', array($Encuesta->id), array('class' => 'btn btn-danger', 'style'=>'width:180px; height:180px; padding-top: 10%')) }}
		@else
			{{ link_to_route('AsignarPanelistas', 'Activar', array($Encuesta->id), array('class' => 'btn btn-success', 'style'=>'width:180px; height:180px; padding-top: 10%')) }}
		@endif
		{{ link_to_route('AsignarPanelistas', 'Pagos', array($Encuesta->id), array('class' => 'btn btn-info', 'style'=>'width:180px; height:180px; padding-top: 10%')) }}
	</div>
@else
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Encuestas Disponibles
  </div>
@endif

@stop
