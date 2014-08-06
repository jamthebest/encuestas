<?php

class Respuesta extends Eloquent {
	protected $guarded = array();

	protected $table = 'respuestas';

	public static $rules = array(
		'id' => '',
		'descripcion' => 'required',
		'opcion' => 'required'
	);
}
