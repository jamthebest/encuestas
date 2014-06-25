@extends('layouts.scaffold')

@section('main')

<h2 class="sub-header"><span class="glyphicon glyphicon-cog"></span>{{ $encuesta->nombre }}</h2>

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
            <h2 class="col-md-12" style="margin-top:5%">{{$pregunta->descripcion}}</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            @if ($pregunta->tipo != 1)
                                <th>Respuesta</th>
                                <th>Cantidad</th>
                                <th>Porcentaje</th>
                            @else
                                <th>Respuestas</th>
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
                                        <td>{{($resultados[$opcion->id]/$cont)*100}}%</td>
                                    @else
                                        <div class="modal fade" id="recibida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#recibida">
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
    {{ link_to_route('Resultados.todos', 'Regresar', null, array('class' => 'btn btn-primary')) }}
</div>
@stop