<?php

class Pregunta extends Eloquent {
	protected $guarded = array();

	protected $table = 'preguntas';

	public static $rules = array(
		'id' => '',
		'descripcion' => 'required',
		'tipo' => 'required',
		'encuesta' => 'required'
	);
}
