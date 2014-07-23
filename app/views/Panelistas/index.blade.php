@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Mis Encuestas</h3>
    <div class="pull-right">
        <a href="{{{ URL::to('Inicio') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
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

@if ($Encuestas)
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Nombre</th>
        <!--<th>Promopuntos</th>-->
      </tr>
    </thead>

    <tbody>
      @foreach ($Encuestas as $encuesta)
        <tr>
          <td>{{{ $encuesta->nombre }}}</td>
          <th>Al Contestar Participará en la rifa de Grandes Premios</th>
          <!--<td>{{{ $encuesta->promopuntos }}}</td>-->
          @if ($encuesta->contestada == 0)
            <td>{{ link_to_route('Bienvenida', 'Contestar', array($encuesta->id), array('class' => 'btn btn-success')) }}</td>
          @else
            <td>{{ link_to_route('Bienvenida', 'Contestar', array($encuesta->id), array('class' => 'btn btn-success', 'disabled')) }}</td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-left:-8%">{{$Encuestas->links()}}</div>
@else
  <div class="alert alert-danger">
    <strong>Oh no!</strong> No Tienes Encuestas Disponibles
  </div>
@endif
@stop
