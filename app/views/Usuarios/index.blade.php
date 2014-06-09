@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span> Usuarios </h2>

<div class="btn-agregar">
	<a type="button" href="{{ URL::to('Inicio') }}" class="btn btn-primary">
	  <span class="glyphicon glyphicon-home"></span> Inicio
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
@endif

@if ($Usuarios->count())
	<div class="table-responsive">
	<table class="table table-striped" style="margin-left:-10%;">
		<thead>
			<tr>
				<th>ID</th>
				<th>Usuario</th>
				<th>Correo</th>
				<th>Tipo</th>
				<th>Activo</th>
				<th>Fecha Creación</th>
				<th>Fecha Actualización</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($Usuarios as $usuario)
				<tr>
					<td>{{{ $usuario->id }}}</td>
					<td>{{{ $usuario->username }}}</td>
					<td>{{{ $usuario->correo }}}</td>
					<td>{{{ $usuario->tipo }}}</td>
					<td>{{{ $usuario->activo == 1 ? 'Activo' : 'Inactivo' }}}</td>
					<td>{{{ $usuario->created_at }}}</td>
					<td>{{{ $usuario->updated_at }}}</td>
					<td>{{ link_to_route('Usuarios.edit', 'Editar', array($usuario->id), array('class' => 'btn btn-info')) }}</td>
          <td>
              {{ Form::open(array('method' => 'DELETE', 'route' => array('Usuarios.destroy', $usuario->id))) }}
                  {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
              {{ Form::close() }}
          </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	<div style="margin-left:-12%">{{$Usuarios->links()}}</div>
@else
	<div class="alert alert-danger">
    <strong>Oh no!</strong> No hay Usuarios Disponibles
  </div>
@endif

@stop
