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
@else
  @if (Session::has('message'))
    <div class="alert alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      {{ Session::get('message') }}
    </div>
  @endif
@endif

@if ($Encuesta)
  <div class="text-center" style="margin-top:15%;margin-bottom:17%;">
    <h1>{{ $Encuesta->despedida }}</h1>
  </div>
  <nav style="margin-bottom:2%" class="navbar navbar-default navbar-fixed-bottom text-center" role="navigation">
    <a href="{{{ URL::to('MisEncuestas') }}}" class="btn btn-primary">
      Continuar
    </a>
  </nav>
@else
  <div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Encuestas Disponibles
  </div>
@endif

@stop
