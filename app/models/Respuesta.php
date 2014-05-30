<?php

class Respuesta extends Eloquent {
	protected $guarded = array();

	protected $table = 'respuestas';

	public static $rules = array(
		'id' => 'required',
		'descripcion' => 'required',
		'opcion' => 'required'
	);
}
