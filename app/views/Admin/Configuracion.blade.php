@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> Configuración </h2>
<div class="page-header clearfix">
    <div class="pull-right">
        <a href="{{{ URL::to('Inicio') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-home"></span> Inicio</a>
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

<div class="btn-agregar" style="text-align: center; margin-top:3%">
    {{ link_to_route('Ciudades.index', 'Ciudades', array(), array('class' => 'btn btn-warning', 'style'=>'width:160px; height:160px; margin-right:6%; padding-top: 8%;')) }}
    {{ link_to_route('Precios.index', 'Precios', array(), array('class' => 'btn btn-primary', 'style'=>'width:160px; height:160px; margin-right:5%; padding-top: 8%')) }}
    {{ link_to_route('NivelSocioEconomicos.index', 'NSE', array(), array('class' => 'btn btn-info text-center', 'style'=>'width:160px; height:160px; margin-right:5%; padding-top: 8%;')) }}
</div>

<div class="btn-agregar" style="text-align: center; margin-top:3%">
    {{ link_to_route('EdadesRangos.index', 'Edades', array(), array('class' => 'btn btn-success', 'style'=>'width:160px; height:160px; margin-right:6%; padding-top: 8%;')) }}
    {{ link_to_route('Sexos.index', 'Sexos', array(), array('class' => 'btn btn-default', 'style'=>'width:160px; height:160px; margin-right:5%; padding-top: 8%')) }}
</div>


@stop
