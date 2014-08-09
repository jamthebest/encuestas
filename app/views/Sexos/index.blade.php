@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h2 class="pull-left"><span class="glyphicon glyphicon-cog"></span> Sexos </h2>
    <div class="pull-right">
        <a href="{{{ URL::route('Configuracion') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>
</div>

<div class="btn-agregar">
	<a type="button" href="{{ URL::route('Sexos.create') }}" class="btn btn-primary">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Sexo
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

@if ($Sexos->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Activo</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($Sexos as $Sexo)
				<tr>
					<td>{{{ $Sexo->id }}}</td>
					<td>{{{ $Sexo->nombre }}}</td>
					<td>{{{ $Sexo->descripcion }}}</td>
					<td>{{{ $Sexo->activo == 1 ? 'Activo' : 'Inactivo' }}}</td>
                    <td>{{ link_to_route('Sexos.edit', 'Editar', array($Sexo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                    	@if ($Sexo->activo == 1)
	                        {{ Form::open(array('method' => 'DELETE', 'route' => array('Sexos.destroy', $Sexo->id))) }}
	                            {{ Form::submit('Desactivar', array('class' => 'btn btn-danger')) }}
	                        {{ Form::close() }}
	                    @else
	                    	{{ Form::open(array('method' => 'POST', 'route' => array('Sexos.activar', $Sexo->id))) }}
	                            {{ Form::submit('Activar', array('class' => 'btn btn-success')) }}
	                        {{ Form::close() }}
	                    @endif
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div style="margin-left:-8%">{{$Sexos->links()}}</div>
@else
	<div class="alert alert-danger">
	  <strong>Oh no!</strong> No hay Sexos Disponibles
	</div>
@endif

@stop
