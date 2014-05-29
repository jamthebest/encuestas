<?php

class Pregunta extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'id' => 'required',
		'descripcion' => 'required',
		'tipo' => 'required',
		'encuesta' => 'required'
	);
}
