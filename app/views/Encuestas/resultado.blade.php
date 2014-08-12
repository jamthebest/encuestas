@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span>{{ $encuesta->nombre }} <small>Total de Respuestas: <strong> {{ $cont }} </strong> </small> </h2>

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

@if ($preguntas || $texto)
    @foreach ($preguntas as $pregunta)
      <div class="form-group">
          <h1 class="col-md-12" style="margin-top:5%;font-family: vinegar, georgia, serif;font-size: 20px;font-weight: bold;text-transform: uppercase;word-spacing: 2pt;color:#D62B2B">¿ {{$pregunta->descripcion}} ?</h1>
          <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          @if ($pregunta->tipo != 1)
                              <th style="font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold">Respuesta</th>
                              <th style="font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold">Cantidad</th>
                              <th style="font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold">Porcentaje</th>
                              @if ($pregunta->tipo == 6 || $pregunta->tipo == 7)
                                  <th style="font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold;">Ver Respuestas</th>
                              @endif
                          @else
                              <th style="font-family: helvetica, sans-serif;font-size: 15px;font-weight: bold;">Respuestas</th>
                          @endif
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($opciones as $opcion)
                          <tr>
                              @if ($opcion->pregunta == $pregunta->id)
                                  @if ($pregunta->tipo != 1)
                                      <td>{{$opcion->descripcion}}</td>
                                      <td>{{$resultados[$opcion->id]}}</td>
                                      <td>{{($resultados[$opcion->id]/($cont == 0 ? 1 : $cont))*100}}%</td>
                                      @if (($pregunta->tipo == 6 || $pregunta->tipo == 7) && ($opcion->descripcion == 'Otro'))
                                          <div class="modal fade" id="{{$opcion->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                  <h4 class="modal-title text-center" id="myModalLabel">Respuestas</h4>
                                                </div>
                                                <div class="modal-body text-center">
                                                  {{ $texto[$opcion->id] }}
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <td>
                                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$opcion->id}}">
                                                Ver Respuestas
                                              </button>
                                          </td>
                                      @else
                                          <td></td>
                                      @endif
                                  @else
                                      <div class="modal fade" id="{{$opcion->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title text-center" id="myModalLabel">Respuestas</h4>
                                            </div>
                                            <div class="modal-body text-center">
                                              {{ $texto[$opcion->id] }}
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <td>
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$opcion->id}}">
                                            Ver Respuestas
                                          </button>
                                      </td>
                                  @endif
                              @endif
                          </tr>
                      @endforeach
                  </tbody>
              </table>
              
          </div>
      </div>
    @endforeach
@endif

<div class="form-group col-md-12 text-center" style="margin-top:5%">
    {{ link_to_route('Resultados', 'Regresar', null, array('class' => 'btn btn-primary')) }}
</div>
@stop