<?php

class Respuesta extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'id' => 'required',
		'descripcion' => 'required',
		'opcion' => 'required'
	);
}
