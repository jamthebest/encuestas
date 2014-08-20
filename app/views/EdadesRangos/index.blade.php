@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h2 class="pull-left"><span class="glyphicon glyphicon-cog"></span> Rango de Edades </h2>
    <div class="pull-right">
        <a href="{{{ URL::route('Configuracion') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>
</div>

<div class="btn-agregar">
	<a type="button" href="{{ URL::route('EdadesRangos.create') }}" class="btn btn-primary">
	  <span class="glyphicon glyphicon-file"></span> Nuevo Rango de Edad
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

@if ($EdadesRangos->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Edad Inicial</th>
				<th>Edad Final</th>
				<th>Porcentaje</th>
				<th>Estado</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($EdadesRangos as $EdadesRango)
				<tr>
					<td>{{{ $EdadesRango->id }}}</td>
					<td>{{{ $EdadesRango->edad_inicio }}}</td>
					<td>{{{ $EdadesRango->edad_final }}}</td>
					<td>{{{ $EdadesRango->porcentaje }}}</td>
					<td>{{{ $EdadesRango->activo == 1 ? 'Activo' : 'Inactivo' }}}</td>
                    <td>{{ link_to_route('EdadesRangos.edit', 'Editar', array($EdadesRango->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                    	@if ($EdadesRango->activo == 1)
	                        {{ Form::open(array('method' => 'DELETE', 'route' => array('EdadesRangos.destroy', $EdadesRango->id))) }}
	                            {{ Form::submit('Desactivar', array('class' => 'btn btn-danger')) }}
	                        {{ Form::close() }}
	                    @else
	                    	{{ Form::open(array('method' => 'POST', 'route' => array('EdadesRangos.activar', $EdadesRango->id))) }}
	                            {{ Form::submit('Activar', array('class' => 'btn btn-success')) }}
	                        {{ Form::close() }}
	                    @endif
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div style="margin-left:-8%">{{$EdadesRangos->links()}}</div>
@else
	<div class="alert alert-danger">
	  <strong>Oh no!</strong> No hay EdadesRangos Disponibles
	</div>
@endif

@stop
