@extends('layouts.scaffold')

@section('main')

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

{{ Form::open(array('route' => 'Registrar')) }}
<div class="row">    
    <h2 class="form-signin-heading text-center">Ingrese Sus Datos</h2>
    <div class="row col-md-7 col-md-push-1" style="margin-left:-8%;">
        <h3 class="form-signin-heading text-center">Datos</h3>
            <div class="form-group">
                {{ Form::label('empresa', 'Empresa:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::text('empresa',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'empresa', 'placeholder' => 'Nombre de la Empresa', 'autofocus')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('rtn', 'RTN:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::text('rtn',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'rtn', 'placeholder' => 'RTN de la Empresa')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('direccion', 'Dirección:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::textarea('direccion',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'direccion', 'placeholder' => 'Dirección de la Empresa', 'rows' => '3')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('telefono', 'Teléfono Emp.:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::text('telefono',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'telefono', 'placeholder' => 'Número Teléfonico de la Empresa')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('correo_emp', 'Correo Emp.:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::text('correo_emp',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'correo_emp', 'placeholder' => 'Correo Electrónico de la Empresa')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('representante', 'Representante:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::text('representante',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'representante', 'placeholder' => 'Nombre del Representate Legal')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('contacto', 'Contacto:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::text('contacto',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'contacto', 'placeholder' => 'Nombre del Contacto')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('correo_contacto', 'Correo Cont.:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::text('correo_contacto',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'correo_contacto', 'placeholder' => 'Correo Electrónico del contacto')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('telefono_contacto', 'Teléfono Cont.:', array('class' => 'col-md-4 control-label')) }}
                <div class="col-md-8">
                    {{ Form::text('telefono_contacto',null, array('class' => 'form-control', 'style' => 'margin-bottom:2%;', 'id' => 'telefono_contacto', 'placeholder' => 'Número telefónico del contacto')) }}
                </div>
            </div>
    </div>
    <div class="row col-md-5 col-md-offset-1">
        <h3 class="form-signin-heading text-center">Datos de Usuario</h3>
        <label for="username">Usuario:</label>
        {{ Form::text('username',null, array('class' => 'form-control', 'id' => 'username', 'placeholder' => 'Nombre de Usuario')) }}
        <span class="help-block"><strong>Atención.</strong> Este nombre se Utilizará para Ingresar a su Cuenta</span>
        <label for="correo">Correo Electrónico:</label>
        {{ Form::text('correo',null, array('class' => 'form-control', 'id' => 'correo', 'placeholder' => 'Correo Electrónico')) }}
        <span class="help-block">Puede Utilizar el Correo de la Empresa</span>
        <label for="password">Contraseña:</label>
        {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña')) }}
        <span class="help-block">La Contraseña Debe Tener Más de 5 Letras y/o Dígitos.</span>
    </div>
    <div class="col-md-3 col-md-push-2" style="margin-top:2%;">
        {{ Form::submit('Crear Cuenta', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    </div>
</div>
    <script>$("#iusername").focus();</script>
    <div class="push"></div>
    {{ Form::hidden('tipo', 'cliente') }}
    {{ Form::close() }}

@stop


