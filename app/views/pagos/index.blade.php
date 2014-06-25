@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
		<h2 class="sub-header pull-left"><span class="glyphicon glyphicon-cog"></span> Pagos: {{$encuesta->nombre}} </h2>
    <div class="pull-right">
        <a href="{{{ URL::to('Encuestas/Configurar/' . $encuesta->id) }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>
</div>

<div class="btn-agregar">
	<a type="button" href="{{ URL::to('Encuestas/Pagos/' . $encuesta->id) }}" class="btn btn-primary">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Pago
	</a>
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

@if ($pagos->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Monto</th>
				<th>Fecha</th>
				<th>Encuesta</th>
				<th>Descripcion</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($pagos as $pago)
				<tr>
					<td>{{{ $pago->monto }}}</td>
					<td>{{{ $pago->fecha }}}</td>
					<td>{{{ $encuesta->nombre }}}</td>
					<td>{{{ $pago->descripcion }}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div style="margin-left:-8%">{{$pagos->links()}}</div>
@else
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Pagos Disponibles
  </div>
@endif

@stop
