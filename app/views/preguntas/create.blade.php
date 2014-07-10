@extends('layouts.scaffold')

@section('main')

<div class="page-header clearfix">
    <h3 class="pull-left">{{$Encuesta->nombre}} &gt; Pregunta <small> &gt; Nueva Pregunta</small></h3>
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

{{ Form::open(array('route' => 'Encuestas.Preguntas.store', 'class' => "form-horizontal" , 'role' => 'form')) }}
    <div class="col-md-8">
    <div class="form-group">
    {{ Form::label('descripcion', 'Pregunta: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-6">
          {{ Form::textarea('descripcion', null, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder'=>'Descripción de la Pregunta', 'rows' => '3', 'maxlength'=>'256')) }}
      </div>
    </div>
    <div class="form-group previsualizar">
    {{ Form::label('tipo', 'Tipo: *', array('class' => 'col-md-2 control-label')) }}
      <div class="col-md-6">
        {{ Form::select('tipo', $tipos, null, array('onChange'=>'previsualizar(this)', 'class' => 'form-control', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Descripción', 'id' => 'tipo', 'placeholder' => '#' )) }}
      </div>
    </div>
    </div>

    <div class="modal fade center-text" style="margin-top:10%" id="previ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-center" id="myModalLabel">Previsualización</h4>
          </div>
          <div class="modal-body text-center" style="margin-top:5%">

            <div style="display:block;margin-left:35%" class="text-example form-group">
              <div class="col-md-5">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Ejemplo Text">
                </div>
              </div>
            </div>
            <div style="display:none;margin-left:38%" class="select-example form-group">
              <div class="col-md-4">
                <div class="form-group">
                  <select placeholder="Ejemplo Select" class="form-control">
                    <option>Opcion 1</option>
                    <option>Opcion 2</option>
                    <option>Opcion 3</option>
                    <option>Opcion 4</option>
                  </select>
                </div>
              </div>
            </div>
            <div style="display:none;margin-left:39%" class="option-example form-group">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" value="option1" checked>
                      Opción 1
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" value="option2">
                      Opción 2
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" value="option2">
                      Opción 3
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" value="option2">
                      Opción 4
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:none;margin-left:39%" class="check-example form-group">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="">
                      Opción 1
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="">
                      Opción 2
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="">
                      Opción 3
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="">
                      Opción 4
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:none;margin-left:40%" class="sino-example form-group">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" value="option2">
                      Si
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" value="option2">
                      No
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:none;margin-left:39%" class="radio-otro-example form-group">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" value="option1" checked>
                      Opción 1
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" value="option2">
                      Opción 2
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" value="option2">
                      Opción 3
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" value="option2">
                      <input type="text" value="Otro">
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:none;margin-left:39%" class="check-otro-example form-group">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="">
                      Opción 1
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="">
                      Opción 2
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="">
                      Opción 3
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="">
                      <input type="text" value="Otro">
                    </label>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#previ" style='margin-top:5%;'>
        Previsualizar
      </button>
    </div>
    {{ Form::hidden('encuesta', $Encuesta->id) }}
    <div class="form-group col-md-10" style="margin-top:5%;">
        <div class="col-md-2 col-md-offset-2">
            {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-md-3">
          {{ link_to_route('Encuestas.Preguntas.Index', 'Cancelar', $Encuesta->id, array('class' => 'btn btn-danger')) }}
            
        </div>
    </div>
{{ Form::close() }}

@stop


