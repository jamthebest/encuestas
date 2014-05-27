<?php

class Cliente extends Eloquent {
	protected $guarded = array();

	protected $table = 'clientes';

	public static $rules = array(
		'id' => '',
		'empresa' => 'required|unique:clientes',
		'rtn' => 'required|unique:clientes',
		'direccion' => '',
		'telefono' => '',
		'correo' => '',
		'representante' => '',
		'contacto' => 'required',
		'correo_contacto' => 'required',
		'telefono_contacto' => '',
		'usuario' => ''
	);
}
