<?php

class RequerimientoCiudad extends Eloquent {
	protected $guarded = array();

	protected $table = 'requerimiento_ciudad';

	public static $rules = array(
		'id' => '',
		'encuesta' => 'required',
		'ciudad' => 'required'
	);
}
