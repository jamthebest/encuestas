<?php

class RequerimientoEdad extends Eloquent {
	protected $guarded = array();

	protected $table = 'requerimiento_edad';

	public static $rules = array(
		'id' => '',
		'encuesta' => 'required',
		'rango' => 'required'
	);
}
