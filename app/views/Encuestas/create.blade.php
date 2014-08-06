@extends('layouts.scaffold')
  
@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">Encuesta <small> &gt; Nueva Encuesta</small></h3>
    <div class="pull-right">
        <a href="{{{ URL::route('Encuestas.index') }}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
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

{{ Form::open(array('route' => 'Encuestas.store', 'class' => "form-horizontal" , 'role' => 'form')) }}
    <div class="col-md-7">
      <div class="form-group">
      {{ Form::label('nombre', 'Nombre: *', array('class' => 'col-md-3 control-label')) }}
        <div class="col-md-8">
            {{ Form::text('nombre', null, array('class' => 'form-control', 'id' => 'nombre', 'placeholder'=>'Nombre de la Encuesta', 'maxlength'=>'128', 'autofocus')) }}
        </div>
      </div>
      <div class="form-group">
      {{ Form::label('panelistas', 'N° Panelistas: *', array('class' => 'col-md-4 control-label')) }}
        <div class="col-md-7">
            {{ Form::text('panelistas', null, array('class' => 'form-control', 'id' => 'panelistas', 'placeholder'=>'Cantidad de Personas a Responder', 'maxlength'=>'10')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('descripcion', 'Descripción:', array('class' => 'col-md-2 control-label')) }}
        <div class="col-md-9">
          {{ Form::textarea('descripcion',null, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder' => 'Mensaje de Bienvenida o Descripción que se mostrará al inicio de la Encuesta a la persona que la responderá', 'rows' => '3')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('despedida', 'Despedida:', array('class' => 'col-md-2 control-label')) }}
        <div class="col-md-9">
          {{ Form::textarea('despedida',null, array('class' => 'form-control', 'id' => 'despedida', 'placeholder' => 'Despedida que se mostrará al finalizar de la Encuesta', 'rows' => '3')) }}
        </div>
      </div>
      {{ Form::hidden('usuario', Auth::user()->id) }}
      <div class="form-group" style="margin-top:5%;">
          <div class="col-md-4 col-md-offset-3">
              {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
          </div>
          <div class="col-md-4">
              <a type="button" href="{{ URL::route('Encuestas.index') }}" class="btn btn-danger">
                  Cancelar
              </a>
          </div>
      </div>
    </div>
    <div class="col-md-5">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>N° Preguntas</th>
            <th>N° Panelistas</th>
            <th>Precio</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($precios as $precio)
            <tr>
              <td>{{{ $precio->preguntas }}}</td>
              <td>{{{ $precio->panelistas }}}</td>
              <td>Lps. {{{ $precio->precio }}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
{{ Form::close() }}

@stop


